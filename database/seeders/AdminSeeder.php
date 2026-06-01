<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\HomeSection;
use App\Models\Menu;
use App\Models\Page;
use App\Models\Post;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Administrator',
                'email' => 'admin@tecotech.com',
                'password' => Hash::make('123@@123'),
                'email_verified_at' => now(),
            ]
        );

        $settings = [
            'site_name' => 'TECOTECH',
            'site_logo' => '/images/logo.png',
            'site_phone' => '0923 392 868',
            'site_email' => 'etm.ckmt@gmail.com',
            'site_facebook' => 'https://www.facebook.com/ETM.JSC/',
            'site_messenger' => 'https://m.me/ETM.JSC',
            'site_instagram' => 'https://www.instagram.com/etmjsc/',
            'site_youtube' => 'https://www.youtube.com/channel/UCra67lg3fKxWjjD4zBhh-mg',
            'site_zalo' => '0923392868',
            'site_headquarters' => 'Ô 15 lô B KĐT Đại Kim - Định Công, P. Định Công, TP. Hà Nội',
            'site_address' => 'Ô 15 lô B KĐT Đại Kim - Định Công, P. Định Công, TP. Hà Nội',
            'company_name' => 'CÔNG TY TNHH TMDV CÔNG NGHỆ KĨ THUẬT MÔI TRƯỜNG VÀ ĐÔ THỊ TECOTECH',
            'south_branch_address' => 'Số 5H9 đường DD12, P. Đông Hưng Thuận, TP. Hồ Chí Minh',
            'south_branch_phone' => '0938 506 659',
            'south_branch_email' => 'sales@moitruongetm.vn',
            'floating_zalo_image' => 'https://cokhimoitruong.com.vn/storage/setting/za_1727925636.webp',
            'floating_back_to_top' => '1',
            'dmca_image' => 'https://cokhimoitruong.com.vn/storage/setting/dmca_1727943209.webp',
            'footer_copyright' => '© Copyright 2008 - 2024 TECOTECH.',
            'home_meta_keywords' => 'tecotech, TECOTECH, xử lý nước thải, xử lý khí thải, xử lý nước cấp, tổng thầu EPC môi trường, gia công cơ khí, cơ khí môi trường',
            'home_meta_robots' => 'index, follow',
            'site_google_map' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3725.2144866632426!2d105.82362037596851!3d20.98404098065494!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ac5df05b5f2f%3A0xb3a5043a4e98f480!2zTMO0IEIsIEvEkFQgxJDhuqFpIEtpbSAtIMSQ4buLbmggQ8O0bmcsIMSQ4buLbmggQ8O0bmcsIEhvw6BuZyBNYWksIEjDoCBO4buZaSwgVmlldG5hbQ!5e0!3m2!1sen!2s!4v1715500000000!5m2!1sen!2s" width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        $pages = [
            [
                'title' => 'Giới thiệu',
                'slug' => 'gioi-thieu',
                'excerpt' => 'Tổng quan về năng lực cơ khí và môi trường của TECOTECH.',
                'hero_image' => 'https://cokhimoitruong.com.vn/storage/setting/anh_1727924566.webp',
                'content' => '<h2>TECOTECH</h2><p>TECOTECH cung cấp giải pháp EPC về xử lý môi trường, gia công cơ khí và chế tạo thiết bị phi tiêu chuẩn.</p>',
            ],
            [
                'title' => 'Tư vấn miễn phí',
                'slug' => 'tu-van',
                'excerpt' => 'Gửi yêu cầu để đội ngũ kỹ sư TECOTECH tư vấn phương án phù hợp.',
                'hero_image' => 'https://cokhimoitruong.com.vn/storage/setting/tu-van_1727943702.webp',
                'content' => '<p>Khách hàng có thể liên hệ hotline hoặc email để được tiếp nhận nhu cầu và sắp xếp lịch khảo sát.</p>',
            ],
            [
                'title' => 'Tuyển dụng',
                'slug' => 'tuyen-dung',
                'excerpt' => 'Thông tin tuyển dụng và cơ hội nghề nghiệp tại TECOTECH.',
                'hero_image' => 'https://cokhimoitruong.com.vn/upload/images/nha-may-gia-cong-co-khi-etm.jpg',
                'content' => '<p>Nội dung tuyển dụng có thể cập nhật trực tiếp trong quản trị trang.</p>',
            ],
            [
                'title' => 'Tổng thầu EPC về môi trường',
                'slug' => 'moi-truong',
                'excerpt' => 'Giải pháp tổng thầu EPC cho các hệ thống xử lý môi trường.',
                'hero_image' => 'https://cokhimoitruong.com.vn/storage/slider/wss-banner-wuse-wwtreatment_1727924183.webp',
                'content' => '<h2>Tổng thầu EPC về môi trường</h2><p>Trang này được quản lý trong Admin > Trang nội dung. Có thể cập nhật mô tả năng lực, hình ảnh, quy trình và các dịch vụ xử lý môi trường.</p>',
            ],
            [
                'title' => 'Gia công cơ khí',
                'slug' => 'gia-cong-co-khi',
                'excerpt' => 'Gia công, chế tạo thiết bị cơ khí phi tiêu chuẩn theo yêu cầu.',
                'hero_image' => 'https://cokhimoitruong.com.vn/upload/images/nha-may-gia-cong-co-khi-etm.jpg',
                'content' => '<h2>Gia công cơ khí</h2><p>Nội dung năng lực nhà máy, thiết bị, sản phẩm và hình ảnh gia công cơ khí có thể cập nhật bằng CKEditor và upload ảnh trực tiếp.</p>',
            ],
            [
                'title' => 'Công trình',
                'slug' => 'cong-trinh',
                'excerpt' => 'Các công trình tiêu biểu đã thực hiện.',
                'hero_image' => 'https://cokhimoitruong.com.vn/storage/category-product/tm1_1728889805.webp',
                'content' => '<h2>Công trình tiêu biểu</h2><p>Quản trị viên có thể cập nhật danh sách công trình, hình ảnh và nội dung giới thiệu tại đây.</p>',
            ],
            [
                'title' => 'Chính sách bán hàng',
                'slug' => 'chinh-sach-ban-hang',
                'excerpt' => 'Thông tin về quy trình bán hàng, báo giá và hỗ trợ khách hàng.',
                'hero_image' => 'https://cokhimoitruong.com.vn/storage/setting/tu-van_1727943702.webp',
                'content' => '<h2>Chính sách bán hàng</h2><p>Cập nhật nội dung chính sách bán hàng trong trang quản trị.</p>',
            ],
            [
                'title' => 'Chính sách về sản phẩm',
                'slug' => 'chinh-sach-san-pham',
                'excerpt' => 'Chính sách liên quan đến sản phẩm, chất lượng và bảo hành.',
                'hero_image' => 'https://cokhimoitruong.com.vn/upload/images/product_1617585689.jpg',
                'content' => '<h2>Chính sách về sản phẩm</h2><p>Cập nhật tiêu chuẩn sản phẩm, bảo hành, nghiệm thu và các điều kiện liên quan tại đây.</p>',
            ],
            [
                'title' => 'Chính sách bảo mật',
                'slug' => 'chinh-sach-bao-mat',
                'excerpt' => 'Cam kết bảo mật thông tin khách hàng.',
                'hero_image' => 'https://cokhimoitruong.com.vn/storage/setting/lienhe_1728534747.webp',
                'content' => '<h2>Chính sách bảo mật</h2><p>Cập nhật nội dung bảo mật thông tin và phạm vi sử dụng dữ liệu khách hàng.</p>',
            ],
            [
                'title' => 'An toàn thông tin',
                'slug' => 'an-toan-thong-tin',
                'excerpt' => 'Hướng dẫn và cam kết về an toàn thông tin.',
                'hero_image' => 'https://cokhimoitruong.com.vn/storage/setting/lienhe_1728534747.webp',
                'content' => '<h2>An toàn thông tin</h2><p>Cập nhật quy định an toàn thông tin và các khuyến nghị cho người dùng.</p>',
            ],
            [
                'title' => 'Thư ngỏ',
                'slug' => 'thu-ngo',
                'excerpt' => 'Thư ngỏ từ TECOTECH gửi đến quý khách hàng và đối tác.',
                'hero_image' => 'https://cokhimoitruong.com.vn/storage/setting/anh_1727924566.webp',
                'content' => '<h2>Thư ngỏ</h2><p>Nội dung thư ngỏ có thể cập nhật trong quản trị trang.</p>',
            ],
            [
                'title' => 'Năng lực công ty',
                'slug' => 'nang-luc',
                'excerpt' => 'Năng lực nhân sự, nhà máy, thiết bị và kinh nghiệm thực hiện dự án.',
                'hero_image' => 'https://cokhimoitruong.com.vn/upload/images/nha-may-gia-cong-co-khi-etm%20(2).jpg',
                'content' => '<h2>Năng lực công ty</h2><p>Quản trị viên có thể cập nhật hồ sơ năng lực, hình ảnh nhà máy, chứng chỉ và dự án tiêu biểu.</p>',
            ],
            [
                'title' => 'Xử lý nước thải',
                'slug' => 'xu-ly-nuoc-thai',
                'excerpt' => 'Thiết kế và thi công hệ thống xử lý nước thải.',
                'hero_image' => 'https://cokhimoitruong.com.vn/storage/category-product/tm1_1728889805.webp',
                'content' => '<h2>Xử lý nước thải</h2><p>Nội dung dịch vụ xử lý nước thải có thể cập nhật bằng CKEditor và upload ảnh trực tiếp.</p>',
            ],
        ];

        foreach ($pages as $page) {
            Page::updateOrCreate(['slug' => $page['slug']], $page + ['is_active' => true]);
        }

        $categories = [
            ['name' => 'Tin tức ngành', 'slug' => 'tin-tuc-nganh', 'order' => 1],
            ['name' => 'Hoạt động công ty', 'slug' => 'hoat-dong-cong-ty', 'order' => 2],
            ['name' => 'Cẩm nang môi trường', 'slug' => 'cam-nang-moi-truong', 'order' => 3],
            ['name' => 'Công trình', 'slug' => 'cong-trinh', 'order' => 4],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(['slug' => $category['slug']], $category + ['is_active' => true]);
        }

        $newsCategory = Category::where('slug', 'tin-tuc-nganh')->first();
        $companyCategory = Category::where('slug', 'hoat-dong-cong-ty')->first();
        $guideCategory = Category::where('slug', 'cam-nang-moi-truong')->first();
        $projectCategory = Category::where('slug', 'cong-trinh')->first();

        $posts = [
            [
                'category_id' => $guideCategory?->id,
                'category' => $guideCategory?->name ?? 'Cẩm nang môi trường',
                'title' => 'Phương pháp xử lý khí thải nhà máy giày da',
                'slug' => 'phuong-phap-xu-ly-khi-thai-nha-may-giay-da',
                'image' => 'https://cokhimoitruong.com.vn/storage/post/xu-ly-khi-thai-nha-may-giay-da-1_1729845974.webp',
                'excerpt' => 'Tổng hợp các giải pháp thu gom, hấp phụ và xử lý khí thải phù hợp cho dây chuyền sản xuất giày da.',
                'content' => '<h2>Xử lý khí thải nhà máy giày da</h2><p>Nhà máy giày da thường phát sinh hơi dung môi, mùi keo, bụi mịn và khí thải từ các công đoạn dán, sấy, mài. Việc thiết kế hệ thống cần bắt đầu từ khảo sát nguồn phát sinh, lưu lượng, nồng độ ô nhiễm và điều kiện vận hành thực tế.</p><p>TECOTECH đề xuất kết hợp chụp hút cục bộ, đường ống gom khí, tháp hấp phụ than hoạt tính hoặc công nghệ xử lý phù hợp theo từng tải lượng. Hệ thống được tính toán để giảm mùi, đảm bảo an toàn vận hành và đáp ứng quy chuẩn môi trường hiện hành.</p>',
            ],
            [
                'category_id' => $projectCategory?->id,
                'category' => $projectCategory?->name ?? 'Công trình',
                'title' => 'Hệ thống xử lý nước cấp cho khu du lịch',
                'slug' => 'he-thong-xu-ly-nuoc-cap-cho-khu-du-lich',
                'image' => 'https://cokhimoitruong.com.vn/storage/post/xu-ly-nuoc-cap-khu-du-lich-1_1776934579.webp',
                'excerpt' => 'Giải pháp xử lý nước cấp ổn định cho khu du lịch, resort và tổ hợp nghỉ dưỡng có nhu cầu sử dụng liên tục.',
                'content' => '<h2>Xử lý nước cấp cho khu du lịch</h2><p>Khu du lịch và resort cần nguồn nước ổn định, đạt yêu cầu về độ trong, mùi, màu, độ cứng và an toàn vi sinh. Công nghệ xử lý thường gồm lắng lọc, khử sắt mangan, lọc áp lực, than hoạt tính, làm mềm và khử trùng.</p><p>Tùy chất lượng nước đầu vào, TECOTECH thiết kế hệ thống theo lưu lượng sử dụng giờ cao điểm, bố trí cụm thiết bị gọn, dễ vận hành và thuận tiện bảo trì trong suốt mùa kinh doanh.</p>',
            ],
            [
                'category_id' => $projectCategory?->id,
                'category' => $projectCategory?->name ?? 'Công trình',
                'title' => 'Xử lý nước thải sản xuất bảng mạch điện tử',
                'slug' => 'xu-ly-nuoc-thai-san-xuat-bang-mach-dien-tu',
                'image' => 'https://cokhimoitruong.com.vn/storage/post/xu-ly-nuoc-thai-san-xuat-bang-mach-dien-tu-1_1776930651.webp',
                'excerpt' => 'Đặc thù nước thải ngành điện tử và các bước xử lý kim loại nặng, hóa chất rửa, bùn thải công nghiệp.',
                'content' => '<h2>Nước thải sản xuất bảng mạch điện tử</h2><p>Nước thải từ quá trình sản xuất bảng mạch có thể chứa kim loại nặng, axit, kiềm, chất hoạt động bề mặt và hóa chất tẩy rửa. Nếu không xử lý đúng quy trình, hệ thống dễ phát sinh bùn nguy hại và biến động chất lượng nước sau xử lý.</p><p>Giải pháp thường kết hợp điều hòa, trung hòa pH, keo tụ tạo bông, lắng, lọc và xử lý bùn. TECOTECH ưu tiên phương án vận hành ổn định, kiểm soát hóa chất rõ ràng và có điểm lấy mẫu thuận tiện cho công tác giám sát.</p>',
            ],
            [
                'category_id' => $newsCategory?->id,
                'category' => $newsCategory?->name ?? 'Tin tức ngành',
                'title' => 'Phát triển kinh tế tư nhân gắn với tăng trưởng xanh',
                'slug' => 'phat-trien-kinh-te-tu-nhan-gan-voi-tang-truong-xanh',
                'image' => 'https://cokhimoitruong.com.vn/storage/post/phat-trien-kinh-te-tu-nhan-gan-voi-tang-truong-xanh-1_1776931304.webp',
                'excerpt' => 'Doanh nghiệp sản xuất đang chuyển dịch theo hướng tiết kiệm năng lượng, kiểm soát phát thải và tuân thủ ESG.',
                'content' => '<h2>Tăng trưởng xanh trong doanh nghiệp sản xuất</h2><p>Tăng trưởng xanh không chỉ là yêu cầu tuân thủ mà còn là lợi thế cạnh tranh của doanh nghiệp sản xuất. Các hệ thống xử lý nước thải, khí thải, thu hồi tài nguyên và tối ưu năng lượng giúp giảm rủi ro pháp lý, giảm chi phí dài hạn và nâng cao hình ảnh thương hiệu.</p><p>Với vai trò tổng thầu EPC môi trường, TECOTECH đồng hành cùng doanh nghiệp từ khảo sát, thiết kế, chế tạo thiết bị đến thi công, vận hành thử và bàn giao hệ thống.</p>',
            ],
            [
                'category_id' => $guideCategory?->id,
                'category' => $guideCategory?->name ?? 'Cẩm nang môi trường',
                'title' => 'Hạt vi nhựa và yêu cầu kiểm soát trong nước thải',
                'slug' => 'hat-vi-nhua-va-yeu-cau-kiem-soat-trong-nuoc-thai',
                'image' => 'https://cokhimoitruong.com.vn/storage/post/hat-vi-nhua-1_1776934939.webp',
                'excerpt' => 'Hạt vi nhựa là vấn đề môi trường mới nổi, cần được nhận diện trong thiết kế và vận hành hệ thống xử lý.',
                'content' => '<h2>Hạt vi nhựa trong nước thải</h2><p>Hạt vi nhựa có kích thước nhỏ, khó quan sát bằng mắt thường và có thể phát sinh từ dệt may, nhựa, bao bì, mỹ phẩm hoặc quá trình sinh hoạt. Việc kiểm soát cần kết hợp giảm phát sinh tại nguồn và tăng hiệu quả tách lọc trong hệ thống xử lý.</p><p>Các công đoạn như song chắn rác tinh, keo tụ tạo bông, lắng, lọc áp lực và màng lọc có thể được cân nhắc tùy tính chất nước thải. Thiết kế đúng giúp giảm tải cho công đoạn sau và ổn định chất lượng nước đầu ra.</p>',
            ],
            [
                'category_id' => $companyCategory?->id,
                'category' => $companyCategory?->name ?? 'Hoạt động công ty',
                'title' => 'Gia công cơ khí chế tạo van thủy lợi theo yêu cầu',
                'slug' => 'gia-cong-co-khi-che-tao-van-thuy-loi-theo-yeu-cau',
                'image' => 'https://cokhimoitruong.com.vn/storage/post/gia-cong-co-khi-che-tao-van-thuy-loi-etm-cover1_1728878669.webp',
                'excerpt' => 'Năng lực gia công, chế tạo thiết bị cơ khí phi tiêu chuẩn phục vụ công trình môi trường và thủy lợi.',
                'content' => '<h2>Gia công cơ khí van thủy lợi</h2><p>TECOTECH nhận gia công và chế tạo các thiết bị cơ khí phi tiêu chuẩn theo bản vẽ hoặc yêu cầu kỹ thuật riêng của từng công trình. Quy trình gồm bóc tách bản vẽ, chọn vật liệu, gia công, hàn, sơn bảo vệ, kiểm tra kích thước và nghiệm thu.</p><p>Với các sản phẩm van thủy lợi, cửa phai, khung giá đỡ và thiết bị phụ trợ, độ kín, độ bền kết cấu và khả năng vận hành ngoài hiện trường là các tiêu chí được kiểm soát chặt trong quá trình chế tạo.</p>',
            ],
        ];

        foreach ($posts as $index => $post) {
            Post::updateOrCreate(
                ['slug' => $post['slug']],
                $post + [
                    'is_active' => true,
                    'created_at' => now()->subDays($index),
                    'updated_at' => now()->subDays($index),
                ]
            );
        }

        $productCategory = ProductCategory::updateOrCreate(
            ['slug' => 'thiet-bi-moi-truong'],
            [
                'name' => 'Thiết bị môi trường',
                'description' => 'Các thiết bị xử lý nước thải, khí thải và cơ khí môi trường do TECOTECH cung cấp.',
                'image' => 'https://cokhimoitruong.com.vn/storage/category-product/tm1_1728889805.webp',
                'order' => 1,
                'is_active' => true,
            ]
        );

        Product::updateOrCreate(
            ['slug' => 'cum-thiet-bi-xu-ly-nuoc-thai'],
            [
                'product_category_id' => $productCategory->id,
                'name' => 'Cụm thiết bị xử lý nước thải',
                'image' => 'https://cokhimoitruong.com.vn/storage/category-product/tm1_1728889805.webp',
                'excerpt' => 'Cụm thiết bị xử lý nước thải thiết kế theo công suất và đặc thù từng công trình.',
                'content' => '<p>Thiết bị được thiết kế, gia công và lắp đặt theo yêu cầu kỹ thuật của từng dự án.</p>',
                'order' => 1,
                'is_active' => true,
            ]
        );

        Menu::whereIn('link', [
            '/',
            '/gioi-thieu',
            '/thu-ngo',
            '/nang-luc',
            '/moi-truong',
            '/xu-ly-nuoc-thai',
            '/cong-trinh',
            '/tin-tuc',
            '/lien-he',
        ])->delete();

        $home = Menu::updateOrCreate(['name' => 'Trang chủ'], ['link' => '/', 'order' => 1]);

        $about = Menu::updateOrCreate(['name' => 'Giới thiệu'], ['link' => '/gioi-thieu', 'order' => 2]);
        Menu::updateOrCreate(['name' => 'Thư ngỏ', 'parent_id' => $about->id], ['link' => '/thu-ngo', 'order' => 1]);
        Menu::updateOrCreate(['name' => 'Năng lực công ty', 'parent_id' => $about->id], ['link' => '/nang-luc', 'order' => 2]);

        $env = Menu::updateOrCreate(['name' => 'Môi trường'], ['link' => '/moi-truong', 'order' => 3]);
        Menu::updateOrCreate(['name' => 'Xử lý nước thải', 'parent_id' => $env->id], ['link' => '/xu-ly-nuoc-thai', 'order' => 1]);

        Menu::updateOrCreate(['name' => 'Công trình'], ['link' => '/cong-trinh', 'order' => 4]);
        Menu::updateOrCreate(['name' => 'Tin tức'], ['link' => '/tin-tuc', 'order' => 5]);
        Menu::updateOrCreate(['name' => 'Liên hệ'], ['link' => '/lien-he', 'order' => 6]);

        if (HomeSection::count() === 0) {
            HomeSection::create([
                'type' => 'hero',
                'name' => 'Hero Slider',
                'order' => 1,
                'data' => [
                    'slides' => [
                        [
                            'image' => 'https://cokhimoitruong.com.vn/storage/slider/wss-banner-wuse-wwtreatment_1727924183.webp',
                            'title' => 'CƠ KHÍ MÔI TRƯỜNG TECOTECH',
                            'highlight' => 'TECOTECH',
                            'desc' => 'Chuyên gia công cơ khí phi tiêu chuẩn, gia công cơ khí theo yêu cầu.',
                        ],
                    ],
                ],
            ]);

            HomeSection::create([
                'type' => 'about',
                'name' => 'Đôi nét về chúng tôi',
                'order' => 2,
                'data' => [
                    'title' => 'Đôi nét về chúng tôi',
                    'content' => 'TECOTECH là Tổng thầu EPC về xử lý môi trường: xử lý nước thải, xử lý khí thải, xử lý nước cấp và sản xuất, gia công, chế tạo các thiết bị cơ khí phi tiêu chuẩn.',
                    'image' => 'https://cokhimoitruong.com.vn/storage/setting/anh_1727924566.webp',
                ],
            ]);

            HomeSection::create([
                'type' => 'services',
                'name' => 'Dịch vụ môi trường',
                'order' => 3,
                'data' => [
                    'title' => 'Dịch vụ môi trường',
                    'subtitle' => 'Chuyên xử lý các vấn đề về môi trường, cung cấp giải pháp hiệu quả cao.',
                    'items' => [
                        ['title' => 'Xử lý nước thải', 'image' => 'https://cokhimoitruong.com.vn/storage/category-product/tm1_1728889805.webp', 'link' => '/xu-ly-nuoc-thai'],
                        ['title' => 'Xử lý khí thải', 'image' => 'https://cokhimoitruong.com.vn/upload/images/cproduct_1577420998.jpg', 'link' => '/xu-ly-khi-thai'],
                    ],
                ],
            ]);

            HomeSection::create([
                'type' => 'partners',
                'name' => 'Đối tác - Khách hàng',
                'order' => 6,
                'data' => [
                    'title' => 'Đối tác - Khách hàng',
                    'images' => [
                        'https://cokhimoitruong.com.vn/storage/setting/DOI-TAC-1_1727925290.webp',
                        'https://cokhimoitruong.com.vn/storage/setting/DOI-TAC-5_1727925343.webp',
                    ],
                ],
            ]);
        }

        if (! HomeSection::where('type', 'featured_projects')->exists()) {
            HomeSection::create([
                'type' => 'featured_projects',
                'name' => 'Công trình tiêu biểu',
                'order' => 4,
                'is_active' => true,
                'data' => [
                    'eyebrow' => 'Danh mục',
                    'title' => 'Công trình tiêu biểu',
                    'product_category_id' => $productCategory->id,
                    'limit' => 2,
                ],
            ]);
        }

        if (! HomeSection::where('type', 'mission')->exists()) {
            HomeSection::create([
                'type' => 'mission',
                'name' => 'Tầm nhìn - Sứ mệnh - Giá trị cốt lõi',
                'order' => 5,
                'is_active' => true,
                'data' => [
                    'title' => 'Tầm nhìn - Sứ mệnh - Mục tiêu',
                    'cards' => [
                        [
                            'key' => 'vision',
                            'title' => 'Tầm nhìn',
                            'content' => 'TECOTECH sẽ trở thành đơn vị hàng đầu trong giải pháp và công nghệ xử lý môi trường, tư vấn môi trường chuyên nghiệp.',
                        ],
                        [
                            'key' => 'mission',
                            'title' => 'Sứ mệnh',
                            'content' => 'Mang đến các giải pháp công nghệ tiên tiến, thân thiện môi trường nhằm góp phần cải thiện chất lượng cuộc sống cộng đồng và gìn giữ hệ sinh thái xanh cho thế hệ tương lai.',
                        ],
                        [
                            'key' => 'goal',
                            'title' => 'Mục tiêu',
                            'content' => 'Đến năm 2035 - 2040: Dẫn đầu thị trường trong nước, mở rộng sang thị trường quốc tế. Ứng dụng 100% công nghệ thân thiện với môi trường. Xây dựng thương hiệu bền vững, nâng cao năng lực cạnh tranh khu vực.',
                        ],
                    ],
                    'coreTitle' => 'Giá trị cốt lõi',
                    'coreValues' => [
                        [
                            'title' => 'Uy tín',
                            'content' => 'Giữ lời hứa với khách hàng, đối tác và cộng đồng. Minh bạch trong mọi hoạt động, đặt chất lượng và sự tin cậy lên hàng đầu.',
                        ],
                        [
                            'title' => 'Sáng tạo - Đổi mới',
                            'content' => 'Luôn tìm tòi giải pháp công nghệ mới, tối ưu hiệu quả xử lý. Khuyến khích nhân viên đề xuất ý tưởng, cải tiến quy trình làm việc.',
                        ],
                        [
                            'title' => 'Trách nhiệm',
                            'content' => 'Phát triển gắn liền với bảo vệ môi trường và lợi ích xã hội. Chăm lo đời sống, an toàn của nhân viên và cộng đồng xung quanh.',
                        ],
                        [
                            'title' => 'Hợp tác - Đồng hành',
                            'content' => 'Xây dựng mối quan hệ bền chặt với khách hàng, đối tác. Coi thành công của khách hàng là thành công của chính mình.',
                        ],
                    ],
                ],
            ]);
        }

        $homeSectionOrder = [
            'hero' => 1,
            'about' => 2,
            'services' => 3,
            'featured_projects' => 4,
            'mission' => 5,
            'partners' => 6,
        ];

        foreach ($homeSectionOrder as $type => $order) {
            HomeSection::where('type', $type)->update(['order' => $order, 'is_active' => true]);
        }

        HomeSection::where('type', 'hero')->get()->each(function (HomeSection $section) {
            $data = $section->data ?? [];

            if (isset($data['slides'][0]) && empty($data['slides'][0]['highlight'])) {
                $data['slides'][0]['highlight'] = 'TECOTECH';
                $section->update(['data' => $data]);
            }
        });
    }
}
