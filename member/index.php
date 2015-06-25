<?php

mb_language("Ja") ;
mb_internal_encoding("UTF-8") ;

//------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
//		VARIABLES
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

$mode = $_POST["mode"];

$formName = $_POST["usr-name"];
$formZip = $_POST["usr-zip"];
$formPrefecture = $_POST["usr-prefecture"];
$formAddress = $_POST["usr-address"];
$formTel = $_POST["usr-tel"];

$me = $_SERVER['PHP_SELF'];
$bClear = true;
$printBuffer = "";
$errorHeader = <<<EOT
<p class="err">入力していただいた項目にエラーがあります。<br>お手数ですが以下よりご確認ください。</p>
EOT;

//	Default & Preview

$head = <<< EOT
<!DOCTYPE html>
<html lang="ja" class="device-desktop">
<head>

  <meta charset="UTF-8">
  <title>冷泉家時雨亭文庫会員 | 公益財団法人 冷泉家時雨亭文庫</title>
  <meta name="description" content="財団法人「冷泉家時雨亭文庫」は、冷泉家に伝わる貴重な文化遺産を、将来にわたり総合的かつ恒久的に継承保存していくことを目的に設立されました。">
  <meta name="keywords" content="冷泉家,冷泉,冷泉家時雨亭文庫,時雨亭,和歌">

  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
  <meta name="format-detection" content="telephone=no">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="/assets/css/font-awesome.min.css">
  <link rel="stylesheet" href="/assets/css/reset.css">
  <link rel="stylesheet" href="/assets/css/style.css">
  <link rel="stylesheet" href="/assets/css/jquery.bxslider.css">

  <!--[if lt IE 9]><script src="/assets/js/html5shiv.min.js"></script><![endif]-->
  <script src="//typesquare.com/accessor/script/typesquare.js?W7M97tGC9VM%3D"></script>

  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-64356770-1', 'auto');
    ga('send', 'pageview');
  </script>
</head>
<body class="contents-page">
  <div class="container">

    <div class="contents-header">
      <header>
        <div class="bg"></div>
        <div class="logo">
      			<h1>冷泉家時雨亭文庫</h1>
      			<h2>公益社団法人</h2>
      			<h3>The Reizei Family</h3>
  		  </div>
      </header>
    </div>

    <form action="$me" method="post">
      <div class="form-contents">
      <div class="lead-txt">
        <h1>冷泉家時雨亭文庫会員</h1>
        <h2 class="en">MEMBERS</h2>
        <p>当文庫の会員入会をご希望の方は右のフォームよりお問い合わせください。<br>後日、会員登録に関する御案内を郵送させていただきます。</p>
        <ul>
          <li>※お問い合わせ項目はすべて必須事項となります。</li>
          <li>※お問い合わせの際はプライバシーポリシーをご確認ください。</li>
          <li>※その他お問い合わせはこちらへ。</li>
        </ul>
      </div>

EOT;


if($mode == "preview" && !$formName){
	$error_name = '<em class="err">お名前を入力してください。</em>' ;
	$bClear = false;
}
if($mode == "preview" && !$formZip){
	$error_zip = '<em class="err">郵便番号を入力してください。</em>' ;
	$bClear = false;
}
if($mode == "preview" && !$formPrefecture){
	$error_prefecture = '<em class="err">都道府県を選択してください。</em>' ;
	$bClear = false;
}
if($mode == "preview" && !$formAddress){
	$error_address = '<em class="err">ご住所を入力してください。</em>' ;
	$bClear = false;
}
if($mode == "preview" && !$formTel){
	$error_tel = '<em class="err">電話番号を入力してください。</em>' ;
	$bClear = false;
}
if($mode == "preview" && preg_match("/^(?![-ー0-9０-９]).+$/", $formZip)){
	$error_zip = '<em class="err">郵便番号は数字で入力してください。</em>' ;
	$bClear = false;
}
if($mode == "preview" && preg_match("/^(?![-ー0-9０-９]).+$/", $formTel)){
	$error_tel = '<em class="err">電話番号は数字で入力してください。</em>' ;
	$bClear = false;
}


if($formName){
	$name_value = 'value="'.$formName.'"';
}
if($formZip){
	$zip_value = 'value="'.$formZip.'"';
}
if($formPrefecture){
	$prefecture_value = 'value="'.$formPrefecture.'"';
}
if($formAddress){
	$address_value = 'value="'.$formAddress.'"';
}
if($formTel){
	$tel_value = 'value="'.$formTel.'"';
}

$prefs = array('北海道','青森県','岩手県','宮城県','秋田県','山形県','福島県', '新潟県','富山県','石川県','福井県', '茨城県','栃木県','群馬県','埼玉県','千葉県','東京都','神奈川県','山梨県','長野県','岐阜県','静岡県','愛知県','三重県','滋賀県','京都府','大阪府','兵庫県','奈良県','和歌山県','鳥取県','島根県','岡山県','広島県','山口県','徳島県','香川県','愛媛県','高知県','福岡県','佐賀県','長崎県','熊本県','大分県','宮崎県','鹿児島県','沖縄県');
foreach($prefs as $pref){
  if($pref == $_POST["usr-prefecture"]){
	   $value .= ('<option value="'.$pref.'" selected>'.$pref.'</option>');      
    } else {
	   $value .= ('<option value="'.$pref.'">'.$pref.'</option>');      
    }
}


$body = <<< EOT

      <div class="form-section">
        <dl>
          <dt>お名前<em>*</em></dt>
          <dd><input class="text-l" type="text" name="usr-name" id="usr-name" $name_value>$error_name</dd>
        </dl>
        <dl>
          <dt>郵便番号<em>*</em></dt>
          <dd><input class="text-s" type="text" name="usr-zip" id="usr-zip" $zip_value><span>例）123-4567</span>$error_zip</dd>
        </dl>
        <dl>
          <dt>都道府県<em>*</em></dt>
          <dd>
            <select class="select required" name="usr-prefecture" id="usr-prefecture">
              <option value="">都道府県</option>
$value
            </select>$error_prefecture
          </dd>
        </dl>
        <dl>
          <dt>ご住所<em>*</em></dt>
          <dd><input class="text-l" type="text" name="usr-address" id="usr-address" $address_value>$error_address</dd>
        </dl>
        <dl>
          <dt>電話番号<em>*</em></dt>
          <dd><input class="text-s" type="text" name="usr-tel" id="usr-tel" $tel_value><span>例）03-1234-5678</span>$error_tel</dd>
        </dl>
        <div class="btn-section">
          <input class="btn" name="commit" type="submit" value="入力内容を確認する">
          <input type="hidden" name="mode" value="preview">
        </div>
      </div>
EOT;

$foot = <<< EOT
    </div>
    </form>

   <footer>
      <div class="inner">
        <section class="info">
          <p>当サイトに掲載のイラスト・写真・文章の無断転載を禁じます。<br>すべての著作権は公益財団法人冷泉家時雨亭文庫に帰属します。</p>
          <h1>公益財団法人 冷泉家時雨亭文庫</h1>
          <address>〒602-0893  <span class="only-phone"><br></span>京都市上京区今出川通烏丸東入玄武町五九九番地</address>
        </section>
        <section class="link">
          <h1>関連機関リンク</h1>
          <div><a href="http://www.kobunka.com/" target="_blank">公益財団法人 京都古文化保存協会</a></figure>
        </section>
      </div>
    </footer>
  
    <div class="copyright">
      <small>Copyright&copy;The Reizei Family All Rights Reserved.</small>
    </div>

  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="/assets/js/jquery.easing1.3.js"></script>
  <script src="/assets/js/jquery.general.responsive.js"></script>
  <script src="/assets/js/jquery.bxslider.min.js"></script>
  <script src="/assets/js/jquery.inview.min.js"></script>
  <script src="/assets/js/jquery.pjax.js"></script>
  <script src="/assets/js/common.js"></script>  

</body>
</html>
EOT;
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
//		POST
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
$postPreview = <<< EOT
<!DOCTYPE html>
<html lang="ja" class="device-desktop">
<head>

  <meta charset="UTF-8">
  <title>冷泉家時雨亭文庫会員 | 公益財団法人 冷泉家時雨亭文庫</title>
  <meta name="description" content="財団法人「冷泉家時雨亭文庫」は、冷泉家に伝わる貴重な文化遺産を、将来にわたり総合的かつ恒久的に継承保存していくことを目的に設立されました。">
  <meta name="keywords" content="冷泉家,冷泉,冷泉家時雨亭文庫,時雨亭,和歌">

  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
  <meta name="format-detection" content="telephone=no">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="/assets/css/font-awesome.min.css">
  <link rel="stylesheet" href="/assets/css/reset.css">
  <link rel="stylesheet" href="/assets/css/style.css">
  <link rel="stylesheet" href="/assets/css/jquery.bxslider.css">

  <!--[if lt IE 9]><script src="/assets/js/html5shiv.min.js"></script><![endif]-->
  <script src="//typesquare.com/accessor/script/typesquare.js?W7M97tGC9VM%3D"></script>

  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-64356770-1', 'auto');
    ga('send', 'pageview');
  </script>
</head>
<body class="contents-page">
  <div class="container">

    <div class="contents-header">
      <header>
        <div class="bg"></div>
        <div class="logo">
      			<h1>冷泉家時雨亭文庫</h1>
      			<h2>公益社団法人</h2>
      			<h3>The Reizei Family</h3>
  		  </div>
      </header>
    </div>

      <div class="form-contents">
      <div class="lead-txt">
        <h1>冷泉家時雨亭文庫会員</h1>
        <h2 class="en">MEMBERS</h2>
        <p>入力内容をご確認の上、よろしければ「送信する」ボタンを押してください。<br>修正される場合は「入力内容を修正する」ボタンより前のページにお戻りください。</p>
      </div>

      <div class="form-section">
        <dl>
          <dt>お名前</dt>
          <dd><em>$formName</em></dd>
        </dl>
        <dl>
          <dt>郵便番号</dt>
          <dd><em>$formZip</em></dd>
        </dl>
        <dl>
          <dt>都道府県</dt>
          <dd><em>$formPrefecture</em></dd>
        </dl>
        <dl>
          <dt>ご住所</dt>
          <dd><em>$formAddress</em></dd>
        </dl>
        <dl>
          <dt>電話番号</dt>
          <dd><em>$formTel</em></dd>
        </dl>
        <div class="btn-section">
    <form action="$me" method="post">
          <input class="btn" name="sendmsg" type="submit" value="送信する">

          <input type="hidden" name="mode" value="post">
          <input type="hidden" name="usr-name" value="$formName">
          <input type="hidden" name="usr-zip" value="$formZip">
          <input type="hidden" name="usr-prefecture" value="$formPrefecture">
          <input type="hidden" name="usr-address" value="$formAddress">
          <input type="hidden" name="usr-tel" value="$formTel">
    </form>
        </div>
      </div>

    </div>      


   <footer>
      <div class="inner">
        <section class="info">
          <p>当サイトに掲載のイラスト・写真・文章の無断転載を禁じます。<br>すべての著作権は公益財団法人冷泉家時雨亭文庫に帰属します。</p>
          <h1>公益財団法人 冷泉家時雨亭文庫</h1>
          <address>〒602-0893  <span class="only-phone"><br></span>京都市上京区今出川通烏丸東入玄武町五九九番地</address>
        </section>
        <section class="link">
          <h1>関連機関リンク</h1>
          <div><a href="http://www.kobunka.com/" target="_blank">公益財団法人 京都古文化保存協会</a></figure>
        </section>
      </div>
    </footer>
  
    <div class="copyright">
      <small>Copyright&copy;The Reizei Family All Rights Reserved.</small>
    </div>

  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="/assets/js/jquery.easing1.3.js"></script>
  <script src="/assets/js/jquery.general.responsive.js"></script>
  <script src="/assets/js/jquery.bxslider.min.js"></script>
  <script src="/assets/js/jquery.inview.min.js"></script>
  <script src="/assets/js/jquery.pjax.js"></script>
  <script src="/assets/js/common.js"></script>  

</body>
</html>

</body>
</html>
EOT;
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
//		Thanks msg
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
$thanksMsg = <<< EOT
<!DOCTYPE html>
<html lang="ja" class="device-desktop">
<head>

  <meta charset="UTF-8">
  <title>冷泉家時雨亭文庫会員 | 公益財団法人 冷泉家時雨亭文庫</title>
  <meta name="description" content="財団法人「冷泉家時雨亭文庫」は、冷泉家に伝わる貴重な文化遺産を、将来にわたり総合的かつ恒久的に継承保存していくことを目的に設立されました。">
  <meta name="keywords" content="冷泉家,冷泉,冷泉家時雨亭文庫,時雨亭,和歌">

  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
  <meta name="format-detection" content="telephone=no">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="/assets/css/font-awesome.min.css">
  <link rel="stylesheet" href="/assets/css/reset.css">
  <link rel="stylesheet" href="/assets/css/style.css">
  <link rel="stylesheet" href="/assets/css/jquery.bxslider.css">

  <!--[if lt IE 9]><script src="/assets/js/html5shiv.min.js"></script><![endif]-->
  <script src="//typesquare.com/accessor/script/typesquare.js?W7M97tGC9VM%3D"></script>

  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-64356770-1', 'auto');
    ga('send', 'pageview');
  </script>
</head>
<body class="contents-page">

  <div class="container">

    <div class="contents-header">
      <header>
        <div class="bg"></div>
        <div class="logo">
      			<h1>冷泉家時雨亭文庫</h1>
      			<h2>公益社団法人</h2>
      			<h3>The Reizei Family</h3>
  		  </div>
      </header>
    </div>

    <div class="form-contents">

      <div class="lead-txt">
        <h1>お申し込みありがとうございました。</h1>
        <p>お申し込みを受け付けました。本フォームより入力いただいた情報は、<br>当文庫で責任を持って管理し、会員様への御連絡等のために利用させていただきます。<br>御案内お届けまで、今しばらくお待ちくださいませ。</p>

        <div class="btn-section">
          <a href="/">トップページに戻る</a>
        </div>
      </div>

    </div>

    <footer>
      <div class="inner">
        <section class="info">
          <p>当サイトに掲載のイラスト・写真・文章の無断転載を禁じます。<br>すべての著作権は公益財団法人冷泉家時雨亭文庫に帰属します。</p>
          <h1>公益財団法人 冷泉家時雨亭文庫</h1>
          <address>〒602-0893  <span class="only-phone"><br></span>京都市上京区今出川通烏丸東入玄武町五九九番地</address>
        </section>
        <section class="link">
          <h1>関連機関リンク</h1>
          <div><a href="http://www.kobunka.com/" target="_blank">公益財団法人 京都古文化保存協会</a></figure>
        </section>
      </div>
    </footer>
  
    <div class="copyright">
      <small>Copyright&copy;The Reizei Family All Rights Reserved.</small>
    </div>

  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="/assets/js/jquery.easing1.3.js"></script>
  <script src="/assets/js/jquery.general.responsive.js"></script>
  <script src="/assets/js/jquery.bxslider.min.js"></script>
  <script src="/assets/js/jquery.inview.min.js"></script>
  <script src="/assets/js/jquery.pjax.js"></script>
  <script src="/assets/js/common.js"></script>  

</body>
</html>
EOT;
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
//		DISPLAY
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

switch($mode){
	case "preview":
		if($bClear){
			print $postPreview;
		}else{
			print $head.$errorHeader.$body.$foot;
		}
		break;
	case "post":
		if($bClear && $_POST['sendmsg']){
			$mailto="member@reizeike.jp,kamimura@unit-base.com";
//			$mailto="kamimura@unit-base.com";

			$subject="冷泉家時雨亭文庫会員のお申し込み";
			$content="お名前：\n".$formName."\n\n郵便番号：\n".$formZip."\n\n都道府県：\n".$formPrefecture."\n\nご住所：\n".$formAddress."\n\n電話番号：\n".$formTel;
			$mailfrom="From:<webmaster@reizeike.jp>";
			mb_send_mail($mailto,$subject,$content,$mailfrom);
			print $thanksMsg;	
		}else{
			print $head.$body.$foot;
		}
		break;
	default:
		print $head.$body.$foot;
		break;
}
?>