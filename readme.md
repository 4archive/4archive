# 4archive

4archive was a popular 4chan archiving service founded January 17, 2014. On May 7th, 9:15 PM, 4archive shut down due to personal decisions. At the time of shut down, 4archive 
stored 57,674 threads, 9,754,504 posts, and 3,235,393 images and gained over 26,000,000 page views, and 6,700,000 unique users.

# System
Utilizing selective archiving, users can choose what they want archived from 4chan. All images are stored away on Imgur and Imageshack servers due to storage costs.

The backend system is powered by [Lumen](http://lumen.laravel.com), a micro-framework created by [Laravel](http://laravel.com). Our backend database is MySQL 5.

**No support will be given for setting this up. Please only open issues for real bugs or mistakes I made.**

# What this source doesn't come with
- E-mail notitifications for takedown requests
- Terms of Service
- Donation page
- Automatic tweets
- Board lists (The support is there though)

# What this source does come with
- Automatic take down requests
- Full archiving process.
- Uploading images to Imgur/Imageshack
- Popular threads listing
- Latest threads listing

# Backwords Compatibility for Old Schemas
When 4archive shut down, it's database was also released the public in a shutdown message I left (You can read the shutdown message below).

This new version of the 4archive code was written before I decided to shut down 4archive. **The schemas are different!! You cannot use this code for the old schemas!!!** In order to achieve backwords compatibility, you must line up the columsn from the old database to this new database. Or just alter the source. It's very clean and easy to modify if you know your way around Laravel.

Here's a gist of what is changed in the schemas:
-  Tables now have foreign keys.
-  `threads_id` is now `thread_id` in all applicable tables.
-  `available` is now `deleted_at` to be Laravel friendly.
-  Primary key and foreign keys are now `int(10)` and `int(10) unsigned` respectively.
-  Normal integers are now `int(11)`
-  `created_at` and `updated_at` columns added across all tables.
-  Posts table specific:
    -  `chan_image_name` is dropped.
    -  `image_dimensions` and `thumb_dimensions` are now `image_width`, `image_height`, `thumb_width`, and `thumb_height`
    -  `chan_post_date` is now `post_timestamp` and is now a `timestamp` type.
-  Threads table specific:
    -  `archive_date` and `update_date` are dropped and replaced with `created_at` and `deleted_at`
    -  `user_ips` is dropped and records are now placed in the `update_records` table.
    -  `admin_note` is dropped.
    -  `alive` is dropped.
    -  `tweeted` is now `tweeted_at (timestamp)`

You can find the original SQL dumps [here](http://archive.org/details/4archive).

#### But why didn't you release the old code??? ####
Because I didn't want to release code that I am not proud of. This code I am very happy with. It's easy to move from server to server, it's flexible, and it's core framework has great documentation. The original 4archive code was a custom framework I made a long time ago. I'd rather bury it.

##

 **The original shutdown message read as follows:**
 
>4archive.org started January 17, 2014 and has since become one of the most popular 4chan archives currently alive. Sadly, today, May 7, 2015, 4archive is shutting down all operations. Since it's arrival, 4archive stored 57,674 threads, 9,754,504 posts, and 3,235,393 images and gained over 26,000,000 page views, and 6,700,000 unique users. 4archive was also the only 4chan archiver that archived /b/.
>
>Today, I am releasing the trove of archived content for the public to archive themselves. These threads should not be lost because 4archive goes down, and I hope the records find a safe home. I will also, in the coming weeks, be releasing code for a new version of 4archive I was working on created in Lumen, a micro-framework in PHP created by the developers who made Laravel. Hopefully, someone can find it useful. I will have 4archive.org redirect to the repository when it is available.
>
>I'm sure a lot of people will want to know the reason why 4archive is going down. The reason 4archive is going down is because frankly I don't want to take care of it anymore. Honestly, I felt a bit of a disgust with what was being archived. I didn't feel good about hosting archived content that actually upset people. Not only that, but I had to pay $50 a month to the hosting provider to keep 4archive up and sometimes had to pay that out-of-pocket, and I don't have that much money :(. With that said, I welcome anyone to take the place of 4archive. Hopefully, the SQL dump can be a good start for you.

>If you plan on reviewing these dumps, try not to judge my column names :( These schemas were made a long time ago, and I've since learned my lesson. Also, I would really appreciate it if someone downloaded this and re-uploaded it somewhere else. 4archive.org will be 100% unavailable starting May 13, 2015. It'd be a shame if this archive was lost.