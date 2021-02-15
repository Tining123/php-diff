<?php
require 'src/TextDiff.php';

$text1 = 'Lorem ipsum dolor sit amet. Nulla tincidunt faucibus enim, a iaculis nisl venenatis a. Scelerisque erat quis massa facilisis vulputate. Morbi quis magna eget elit lobortis aliquet ut sit amet nulla. Morbi fermentum aliquam ex ac tempus.
Integer scelerisque, magna ut commodo vulputate, diam neque sodales nisl.
nulla tincidunt faucibus enim, a iaculis nisl venenatis a.';
$text2 = 'Lorem ipsum dolor sit amet. Scelerisque erat quis massa facilisis vulputate. Morbi quis magna eget elit lobortis aliquet ut sit amet nulla. Morbi fermentum aliquam ex ac tempus. Donec lectus eros, egestas sed est eget, pharetra gravida mauris.
Integer scelerisque, magna ut commodo vulputate, diam neque sodales nisl.
Duis vitae mollis felis. Phasellus porttitor lorem vel nisi elementum, ac molestie nibh suscipit.
Nulla tincidunt faucibus enim, a iaculis nisl venenatis.';

if(!empty($_POST["t1"])){
    $text1 = $_POST["t1"];
}
if(!empty($_POST["t2"])){
    $text2 = $_POST["t2"];
}

?>

<html>
<head>
	<title>TextDiff</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<style>
	    .main{
        	width:800px;
        	padding: 7px;
		    margin:0 auto;
		    display: flex;
        }
	</style>
</head>

<body>
    <!-- back to top -->
<style>
    .back-to-button {
      position: fixed;
      /* 位置是固定的 */
      bottom: 20px;
      /* 显示在页面底部 */
      right: 30px;
      /* 显示在页面的右边 */
      z-index: 99;
      /* 确保不被其他功能覆盖 */
      border: 1px solid #5cb85c;
      /* 显示边框 */
      outline: none;
      /* 不显示外框 */
      background-color: #fff;
      /* 设置背景背景颜色 */
      color: #5cb85c;
      /* 设置文本颜色 */
      cursor: pointer;
      /* 鼠标移到按钮上显示手型 */
      padding: 10px 15px 15px 15px;
      /* 增加一些内边距 */
      border-radius: 10px;
      /* 增加圆角 */
    }

    .back-to-button:hover {
      background-color: #5cb85c;
      /* 鼠标移上去时，反转颜色 */
      color: #fff;
    }
    .back-to-top {
      position: fixed;
      /* 位置是固定的 */
      bottom: 70px;
      /* 显示在页面底部 */
      right: 30px;
      /* 显示在页面的右边 */
      z-index: 99;
      /* 确保不被其他功能覆盖 */
      border: 1px solid #5cb85c;
      /* 显示边框 */
      outline: none;
      /* 不显示外框 */
      background-color: #fff;
      /* 设置背景背景颜色 */
      color: #5cb85c;
      /* 设置文本颜色 */
      cursor: pointer;
      /* 鼠标移到按钮上显示手型 */
      padding: 10px 15px 15px 15px;
      /* 增加一些内边距 */
      border-radius: 10px;
      /* 增加圆角 */
    }

    .back-to-top:hover {
      background-color: #5cb85c;
      /* 鼠标移上去时，反转颜色 */
      color: #fff;
    }
  </style>
  <button class="js-back-to-button back-to-button" title="到达底部">︾</button>
  <button class="js-back-to-top back-to-top" title="回到头部">︽</button>
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script>
    $(function() {
      var $win = $(window);
      var $backToTop = $('.js-back-to-top');
      var $backToButton = $('.js-back-to-button');
      
      // 当用户点击按钮时，通过动画效果返回头部
      $backToTop.click(function() {
        $('html, body').animate({
          scrollTop: 0
        }, 200);
      });
      $backToButton.click(function() {
        $('html, body').animate({
          scrollTop: $(document).height()
        }, 200);
      });
    });
  </script>
	<div style="width:800px;margin:auto;">
		<?= Qazd\TextDiff::render($text1, $text2) ?>
	</div>
    <?php
        $result="fail";
		if (strcmp($text1,$text2 )==0) {
			//相等
			echo('<div class=main style="margin:auto;">');
			echo("<br>完全相等");
			echo('</div>');
		}
    ?>
	<div class=main style="margin:auto;">
        <tbody>
            <tr>
                <td class="diff-deletedline"><textarea style="width:400px;height:200px;margin:auto;" name="t1" form="usrform"><?php if(!empty($_POST["t1"])){print($_POST["t1"]);} ?></textarea></td>
                <td style="width:400px;padding:7px;">&nbsp;</td>
                <td class="diff-addedline"><textarea style="width:400px;height:200px;margin:auto;" name="t2" form="usrform"><?php if(!empty($_POST["t2"])){print($_POST["t2"]);} ?></textarea></td>
            </tr>
        </tbody>
    </div>
    <div class=main style="margin:auto;">
        <form action="index.php" id="usrform" method="post">
          <input type="submit">
        </form>
    </div>
    <div class=main style="margin:auto;">
      <a href="/server_app/text-diff/index.php"><button>重置</button></a>
    </div>
</body>
</html>
