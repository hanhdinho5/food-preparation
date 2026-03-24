<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        Blog::query()->delete();

        $authors = User::query()->orderBy('id')->get();

        if ($authors->isEmpty()) {
            return;
        }

        $pickAuthorId = function (int $index) use ($authors): int {
            return $authors[$index % $authors->count()]->id;
        };

        $blogs = [
            [
                'title' => 'Phở bò Hà Nội: Vì sao món ăn này luôn nằm trong danh sách phải thử?',
                'excerpt' => 'Phở bò không chỉ là món ăn sáng quen thuộc mà còn là một biểu tượng ẩm thực Việt với nước dùng trong, thơm và chiều sâu hương vị rất riêng.',
                'content' => <<<'HTML'
<h2>Hương vị làm nên bản sắc</h2>
<p>Phở bò Hà Nội gây ấn tượng nhờ nước dùng trong, thanh nhưng vẫn đậm đà. Xương bò được hầm kỹ cùng hành nướng, gừng nướng và các loại gia vị như quế, hồi, thảo quả để tạo nên mùi thơm rất đặc trưng.</p>
<p>Một bát phở ngon không cần quá nhiều thành phần cầu kỳ. Điều quan trọng là sự cân bằng giữa nước dùng, bánh phở mềm, thịt bò tươi và phần rau ăn kèm vừa đủ.</p>
<h2>Cách thưởng thức đúng vị</h2>
<p>Nên chan nước dùng thật nóng lên phần thịt bò thái mỏng để thịt vừa chín tới, giữ được độ ngọt tự nhiên. Khi ăn, có thể thêm hành lá, tiêu xay và một ít chanh để làm nổi bật vị thanh của món.</p>
<ul>
<li>Chọn xương ống và xương đuôi để nước dùng ngọt tự nhiên.</li>
<li>Nướng hành và gừng trước khi nấu để dậy mùi.</li>
<li>Không nêm quá nhiều gia vị mạnh làm át mùi bò.</li>
</ul>
<p>Phở bò vì thế không chỉ là món ăn ngon mà còn là ví dụ rõ ràng cho sự tinh tế trong ẩm thực miền Bắc.</p>
HTML,
            ],
            [
                'title' => 'Bún chả: Món ăn dân dã nhưng đủ sức chinh phục thực khách quốc tế',
                'excerpt' => 'Bún chả hấp dẫn nhờ phần thịt nướng thơm lừng, nước chấm chua ngọt hài hòa và rau sống ăn kèm tạo cảm giác rất cân bằng.',
                'content' => <<<'HTML'
<h2>Điểm hấp dẫn nằm ở sự đối lập hài hòa</h2>
<p>Bún chả là món ăn có cấu trúc hương vị rất thú vị. Thịt nướng đậm vị, hơi xém cạnh đi cùng nước chấm chua ngọt nhẹ, thêm đu đủ xanh giòn và bún tươi mềm làm tổng thể món ăn trở nên dễ ăn mà không ngấy.</p>
<p>Phần thịt thường có hai loại: thịt ba chỉ thái mỏng để nướng và chả viên từ thịt xay để tạo độ mềm. Khi kết hợp trong cùng một phần ăn, món ăn trở nên phong phú hơn về kết cấu.</p>
<h2>Mẹo để món bún chả ngon hơn</h2>
<ol>
<li>Ướp thịt với nước mắm, hành tím, mật ong hoặc đường để tạo màu đẹp khi nướng.</li>
<li>Nướng bằng than sẽ cho mùi thơm hấp dẫn hơn so với áp chảo.</li>
<li>Pha nước chấm theo hướng thanh nhẹ để làm nổi bật phần thịt.</li>
</ol>
<p>Bún chả là món ăn thể hiện rất rõ tinh thần ẩm thực Việt: gần gũi, dễ ăn nhưng có chiều sâu và bản sắc.</p>
HTML,
            ],
            [
                'title' => 'Canh chua cá miền Nam: Bí quyết nấu vị thanh mà vẫn đậm đà',
                'excerpt' => 'Canh chua cá là món ăn quen thuộc trong bữa cơm gia đình miền Nam, nổi bật với vị chua dịu, ngọt thanh và màu sắc rất bắt mắt.',
                'content' => <<<'HTML'
<h2>Vì sao canh chua luôn dễ ăn?</h2>
<p>Canh chua cá hấp dẫn bởi sự kết hợp giữa vị chua của me, vị ngọt từ cá và rau củ, cùng mùi thơm của rau ngổ, ngò om. Đây là món ăn rất hợp với khí hậu nóng vì tạo cảm giác thanh mát và nhẹ bụng.</p>
<p>Cá basa, cá hú hoặc cá lóc đều có thể dùng để nấu. Quan trọng là cá phải tươi và được sơ chế sạch để nước canh không bị tanh.</p>
<h2>Những nguyên tắc nên nhớ khi nấu</h2>
<ul>
<li>Nấu nước me riêng rồi lọc bỏ xác để vị chua sạch và trong.</li>
<li>Cho cá vào khi nước vừa sôi để cá không bị nát.</li>
<li>Các loại rau như bạc hà, cà chua, giá đỗ nên cho vào cuối để giữ độ tươi.</li>
</ul>
<p>Một nồi canh chua ngon là nồi canh có vị chua vừa phải, hậu ngọt rõ và mùi rau thơm nổi bật nhưng không gắt.</p>
HTML,
            ],
            [
                'title' => 'Cơm chiên ngon tại nhà: 5 nguyên tắc giúp hạt cơm tơi và đậm vị',
                'excerpt' => 'Cơm chiên tưởng đơn giản nhưng rất dễ bị nhão hoặc nhạt vị nếu làm sai bước. Chỉ cần nắm đúng vài nguyên tắc cơ bản, món ăn sẽ ngon hơn rõ rệt.',
                'content' => <<<'HTML'
<h2>Chọn nguyên liệu đúng ngay từ đầu</h2>
<p>Cơm để chiên ngon nhất là cơm nguội đã ráo, hạt tơi. Nếu dùng cơm mới nấu còn ẩm, món ăn dễ bị bết và không tạo được độ săn đẹp sau khi đảo.</p>
<p>Trứng, rau củ cắt hạt lựu, thịt hoặc hải sản nên được chuẩn bị sẵn để thao tác nhanh trên chảo nóng.</p>
<h2>5 nguyên tắc quan trọng</h2>
<ol>
<li>Dùng cơm nguội hoặc cơm đã để mát.</li>
<li>Làm nóng chảo trước khi cho dầu.</li>
<li>Xào nhân riêng để kiểm soát độ chín.</li>
<li>Nêm gia vị từng lớp, không đổ dồn một lần.</li>
<li>Đảo nhanh tay trên lửa vừa lớn để cơm săn và thơm.</li>
</ol>
<p>Khi làm đúng các bước này, cơm chiên sẽ có màu sắc đẹp, hạt tơi rõ và mùi thơm rất hấp dẫn dù nguyên liệu không quá cầu kỳ.</p>
HTML,
            ],
            [
                'title' => 'Gỏi cuốn tôm thịt: Món ăn thanh nhẹ phù hợp cho thực đơn cuối tuần',
                'excerpt' => 'Gỏi cuốn là lựa chọn lý tưởng khi cần một món ăn nhẹ, nhiều rau, dễ chuẩn bị và vẫn đủ hấp dẫn để dùng trong bữa gia đình hoặc đãi khách.',
                'content' => <<<'HTML'
<h2>Sự hấp dẫn đến từ cảm giác tươi mới</h2>
<p>Gỏi cuốn không dùng nhiều dầu mỡ nhưng vẫn tạo cảm giác ngon miệng nhờ sự kết hợp của tôm luộc, thịt ba chỉ, bún, rau sống và lớp bánh tráng mềm mỏng.</p>
<p>Món này đặc biệt phù hợp cho những ngày nóng hoặc khi bạn muốn cân bằng lại thực đơn sau nhiều món đậm vị.</p>
<h2>Cách cuốn đẹp và chắc tay</h2>
<ul>
<li>Làm mềm bánh tráng vừa đủ để không bị rách.</li>
<li>Xếp rau và bún gọn trước, đặt tôm ở ngoài để cuốn lên đẹp mắt.</li>
<li>Cuốn chắc tay nhưng không ép quá mạnh làm nhân bị dồn.</li>
</ul>
<p>Nước chấm đi kèm có thể là mắm nêm hoặc sốt đậu phộng. Mỗi loại mang lại một phong cách thưởng thức khác nhau nhưng đều rất hợp với món cuốn thanh nhẹ này.</p>
HTML,
            ],
            [
                'title' => 'Cách lên kế hoạch nấu ăn trong 30 phút cho người bận rộn',
                'excerpt' => 'Nếu quỹ thời gian hạn chế, việc lên kế hoạch trước khi nấu sẽ giúp bạn tiết kiệm rất nhiều công sức mà bữa ăn vẫn đầy đủ và ngon miệng.',
                'content' => <<<'HTML'
<h2>Bắt đầu từ món chính đơn giản</h2>
<p>Thay vì chọn những món cần nhiều công đoạn, hãy ưu tiên các món xào, canh nhanh hoặc món nướng bằng nồi chiên không dầu. Chỉ cần một món chính hợp lý, phần còn lại của bữa ăn sẽ dễ sắp xếp hơn nhiều.</p>
<p>Bạn có thể kết hợp theo công thức cơ bản: một món mặn, một món rau và một món canh nhẹ. Đây là cách tạo bữa ăn cân bằng mà không mất quá nhiều thời gian.</p>
<h2>Quy trình 30 phút hiệu quả</h2>
<ol>
<li>Chuẩn bị nguyên liệu và gia vị trước khi bật bếp.</li>
<li>Ưu tiên sơ chế rau, thịt theo thứ tự món lâu chín trước.</li>
<li>Nấu canh hoặc luộc trước để tranh thủ thời gian.</li>
<li>Làm món xào hoặc áp chảo sau cùng để món nóng và ngon hơn.</li>
</ol>
<p>Khi có kế hoạch rõ ràng, việc nấu ăn mỗi ngày sẽ nhẹ nhàng hơn nhiều và bạn cũng dễ duy trì thói quen ăn uống tại nhà hơn.</p>
HTML,
            ],
        ];

        foreach ($blogs as $index => $blog) {
            Blog::create([
                'from_user' => $pickAuthorId($index),
                'title' => $blog['title'],
                'slug' => Str::slug($blog['title']),
                'excerpt' => $blog['excerpt'],
                'content' => $blog['content'],
                'thumbnail_path' => null,
                'status' => 'published',
                'published_at' => now()->subDays(6 - $index)->setTime(8 + $index, 30),
            ]);
        }
    }
}