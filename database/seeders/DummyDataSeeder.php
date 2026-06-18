<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Carbon\Carbon;

class DummyDataSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $now = Carbon::now();

        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        $tables = ['settings', 'admins', 'users', 'categories', 'subcategories', 'products', 'orders', 'order_details', 'tags', 'post_tags', 'posts', 'reviews', 'sliders', 'links', 'carts', 'images', 'favorites', 'subscribers', 'comments', 'notifications', 'contacts', 'testmonials'];
        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        // 1. Settings
        DB::table('settings')->insert([
            'logo' => 'logo.png',
            'address' => '123 Fake Street',
            'phone' => '123456789',
            'description' => 'A fake store',
            'hours_working' => '9AM - 5PM',
            'whoweare' => 'We are fake',
            'pageIcon' => 'icon.png',
            'map' => 'map_url_here',
            'tax_rate' => 15.00,
            'email' => 'admin@store.com',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // 2. Admins
        $adminId = DB::table('admins')->insertGetId([
            'name' => 'Super Admin',
            'email' => 'admin@admin.com',
            'type' => 'super_admin',
            'password' => Hash::make('123'),
            'status' => 'active',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // 3. Users
        $userIds = [];
        for ($i = 0; $i < 10; $i++) {
            $userIds[] = DB::table('users')->insertGetId([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => $now,
                'password' => Hash::make('password'),
                'status' => 'active',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // 4. Categories
        $categoryIds = [];
        for ($i = 0; $i < 5; $i++) {
            $categoryIds[] = DB::table('categories')->insertGetId([
                'name' => json_encode(['en' => $faker->word, 'ar' => 'كلمة']),
                'slug' => $faker->slug,
                'imagepath' => 'cat.png',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // 5. Subcategories
        $subcatIds = [];
        foreach ($categoryIds as $catId) {
            for ($i = 0; $i < 3; $i++) {
                $subcatIds[] = DB::table('subcategories')->insertGetId([
                    'name' => json_encode(['en' => $faker->word, 'ar' => 'كلمة فرعية']),
                    'slug' => $faker->slug,
                    'description' => json_encode(['en' => $faker->sentence, 'ar' => 'وصف']),
                    'category_id' => $catId,
                    'imagepath' => 'subcat.png',
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }

        // 6. Products
        $productIds = [];
        foreach ($subcatIds as $subcatId) {
            for ($i = 0; $i < 3; $i++) {
                $productIds[] = DB::table('products')->insertGetId([
                    'name' => json_encode(['en' => $faker->words(3, true), 'ar' => 'منتج']),
                    'slug' => $faker->slug,
                    'description' => json_encode(['en' => $faker->paragraph, 'ar' => 'وصف المنتج']),
                    'price' => $faker->randomFloat(0, 10, 1000),
                    'quantity' => $faker->numberBetween(1, 100),
                    'subcategory_id' => $subcatId,
                    'imagepath' => 'product.png',
                    'views' => 0,
                    'featured' => 0,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }

        // 7. Orders & OrderDetails
        foreach ($userIds as $userId) {
            $orderId = DB::table('orders')->insertGetId([
                'user_id' => $userId,
                'name' => $faker->name,
                'subtotal' => 100,
                'totalprice' => 120,
                'email' => $faker->safeEmail,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'status' => 'pending',
                'payment' => 'cash',
                'note' => $faker->sentence,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            for ($i = 0; $i < 3; $i++) {
                DB::table('order_details')->insert([
                    'order_id' => $orderId,
                    'product_id' => $faker->randomElement($productIds),
                    'quantity' => $faker->numberBetween(1, 5),
                    'price' => $faker->randomFloat(0, 10, 500),
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }

        // 8. Tags
        $tagIds = [];
        for ($i = 0; $i < 5; $i++) {
            $tagIds[] = DB::table('tags')->insertGetId([
                'name' => json_encode(['en' => $faker->word, 'ar' => 'وسم']),
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // 9. Posts & Post_Tags
        $postIds = [];
        for ($i = 0; $i < 10; $i++) {
            $postId = DB::table('posts')->insertGetId([
                'title' => json_encode(['en' => $faker->sentence, 'ar' => 'مقال']),
                'slug' => $faker->slug,
                'description' => json_encode(['en' => $faker->paragraph, 'ar' => 'محتوى']),
                'views' => 0,
                'subcategory_id' => $faker->randomElement($subcatIds),
                'admin_id' => $adminId,
                'imagepath' => 'post.png',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
            $postIds[] = $postId;

            // Attach tags
            DB::table('post_tags')->insert([
                'post_id' => $postId,
                'tag_id' => $faker->randomElement($tagIds),
            ]);
        }

        // 10. Reviews
        foreach ($productIds as $productId) {
            for ($i = 0; $i < 2; $i++) {
                DB::table('reviews')->insert([
                    'product_id' => $productId,
                    'name' => $faker->name,
                    'email' => $faker->safeEmail,
                    'phone' => $faker->phoneNumber,
                    'subject' => $faker->sentence,
                    'status' => 1,
                    'message' => $faker->paragraph,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }

        // 11. Sliders
        for ($i = 0; $i < 3; $i++) {
            DB::table('sliders')->insert([
                'main_title' => json_encode(['en' => $faker->sentence, 'ar' => 'عنوان']),
                'branch_title' => json_encode(['en' => $faker->word, 'ar' => 'فرعي']),
                'imagepath' => 'slider.png',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // 12. Links
        DB::table('links')->insert([
            'fb' => 'https://facebook.com',
            'tw' => 'https://twitter.com',
            'ins' => 'https://instagram.com',
            'li' => 'https://linkedin.com',
            'linkable_type' => 'App\Models\Setting',
            'linkable_id' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // 13. Carts
        foreach ($userIds as $userId) {
            DB::table('carts')->insert([
                'user_id' => $userId,
                'product_id' => $faker->randomElement($productIds),
                'quantity' => $faker->numberBetween(1, 3),
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // 14. Images
        foreach ($productIds as $productId) {
            DB::table('images')->insert([
                'imageable_type' => 'App\Models\Product',
                'imageable_id' => $productId,
                'imagepath' => 'extra_image.png',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // 15. Favorites
        foreach ($userIds as $userId) {
            DB::table('favorites')->insert([
                'user_id' => $userId,
                'product_id' => $faker->randomElement($productIds),
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // 16. Subscribers
        for ($i = 0; $i < 5; $i++) {
            DB::table('subscribers')->insert([
                'email' => $faker->unique()->safeEmail,
                'unsubscribe_token' => Str::random(10),
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // 17. Comments
        foreach ($postIds as $postId) {
            for ($i = 0; $i < 2; $i++) {
                DB::table('comments')->insert([
                    'post_id' => $postId,
                    'name' => $faker->name,
                    'email' => $faker->unique()->safeEmail,
                    'message' => $faker->sentence,
                    'status' => 1,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }

        // 18. Notifications (Using general table structure)
        foreach ($userIds as $userId) {
            DB::table('notifications')->insert([
                'id' => Str::uuid()->toString(),
                'type' => 'App\Notifications\WelcomeNotification',
                'notifiable_type' => 'App\Models\User',
                'notifiable_id' => $userId,
                'data' => json_encode(['message' => 'Welcome']),
                'read_at' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // 19. Contacts
        for ($i = 0; $i < 5; $i++) {
            DB::table('contacts')->insert([
                'name' => $faker->name,
                'email' => $faker->safeEmail,
                'phone' => $faker->phoneNumber,
                'subject' => $faker->sentence,
                'message' => $faker->paragraph,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // 20. Testmonials
        for ($i = 0; $i < 5; $i++) {
            DB::table('testmonials')->insert([
                'name' => $faker->name,
                'email' => $faker->safeEmail,
                'phone' => $faker->phoneNumber,
                'subject' => $faker->sentence,
                'message' => $faker->paragraph,
                'status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
