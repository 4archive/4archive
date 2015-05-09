<?php
namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Request;
use Response;
use DB;
use \App\TakedownRequest as TakedownRequest;
use \App\Thread as Thread;

class TakedownController extends BaseController
{
    public function form()
    {
        return view('takedown');
    }

    public function submit()
    {
        $url = trim(Request::input('uri'));
        $reason = trim(Request::input('reason'));
        $info = trim(Request::input('info'));

        if (!$url || !$reason || !$info) {
            return redirect()->back()->withInput()->with('error', 'Please fill in all of the required fields.');
        }

        $urlRegex = "/\/?([a-z]+)\/?(thread|res)\/?([0-9]+)/";
        $matches = array();
        // Does this url match our pattern?
        if (!preg_match($urlRegex, $url, $matches)) {
            return redirect()->back()->withInput()->with('error', 'The URL you entered is not valid.');
        }

        // Assign values
        $board = $matches[1];
        $thread_id = $matches[3];

        // Does this thread exist?
        $thread = Thread::withTrashed()->where('board', '=', $board)
            ->where('thread_id', '=', $thread_id)
            ->firstOrFail();

        if ($thread->deleted_at != null) {
            return redirect()->back()->withInput()->with('error', 'This thread has already been taken down.');
        }

        // Was this thread denied less than 3 days ago?
        $lastTakedown = TakedownRequest::where('thread_id', '=', $thread->id)->orderBy('id', 'desc')
            ->first();

        if ($lastTakedown) {
            // Was this request denied?
            if ($lastTakedown->processed == 1 && $lastTakedown->approved == 0
                && strtotime($lastTakedown->deleted_at) > (time() - 259200)) { // 3 days

                return redirect()->back()->withInput()->with('error', 'This thread was recently reversed due to a previous takedown request. Please wait before resubmitting.');
            
            } else if ($lastTakedown->processed == 0) {
                return redirect()->back()->withInput()->with('error', 'Someone has already requested this thread be taken down.');
            }
        }

        $request = new TakedownRequest();
        $request->thread_id = $thread->id;
        $request->reason = $reason;
        $request->info_provided = $info;
        $request->user_ip = Request::ip();
        $request->save();

        // Soft delete
        $thread->takedown_reason = "This thread has been automatically taken down - '" . $reason . "'";
        $thread->save();
        $thread->delete();

        return redirect()->back()->with('success', 'Your takedown request has been sent. The thread has been automatically taken down. Please keep in mind that the takedown could be revsered in the future by an Admin.');
    }
}
