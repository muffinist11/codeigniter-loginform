
<!DOCTYPE html>
<html lang="ja">
<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta keyword ="フォームで登録">
  <meta discription ="フォームです">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link rel="stylesheet" href="/CodeIgniterform/css/style.css">
</head>

<body>

  <h1>form</h1>

  <?php if(isset($clean)){
    $page_flag = 1;
    
  }else{
    $page_flag = 0;
  } ?>
  
  <!-- 確認画面 $page_flag1-->
  <?php if($page_flag === 1):?>
    
    <div class="container mt-5 p-lg-5 bg-info" style="text-align:center;">

          <form action="db_act" method="post" class="form">
            
            <div class="form-group element_wrap">
              <p>名前 <?php echo $clean['name'];?></p>
              <p>カナ <?php echo $clean['kana'];?></p>
              <p>電話 <?php echo $clean['tel'];?></p>
              <p>mail <?php echo $clean['mail'];?></p>
              <p>パスワード <?php echo $clean['pass'];?></p>
              <p>生まれ年 <?php echo $clean['year'];?></p>
              <p>性別
              <?php echo $clean['sex'];?></p>
              <p>メールマガジン送付
                <?php if($clean['magagine'] === "1") {
                  echo '受け取る';
                } elseif($clean['magagine'] === "0") {
                  echo '受け取らない';
                }?></p>
            </div>
            
            <input type="submit" name="btn_submit" class="btn btn-success" value="送信">
            
            <!-- sessionで値を渡すパターンも -->
            

            <input type="hidden" name="name" value="<?php echo $clean['name']; ?>">
            <input type="hidden" name="kana" value="<?php echo $clean['kana']; ?>">
            <input type="hidden" name="tel" value="<?php echo $clean['tel']; ?>">
            <input type="hidden" name="mail" value="<?php echo $clean['mail']; ?>">
            <input type="hidden" name="pass" value="<?php echo $clean['pass']; ?>">
            <input type="hidden" name="year" value="<?php echo $clean['year']; ?>">
            <input type="hidden" name="sex" value="<?php echo $clean['sex']; ?>">
            <input type="hidden" name="magagine" value="<?php echo $clean['magagine']; ?>">
            
          </form>
          
          <form action="/Codeigniterform/form/index">
            <input type="submit" class="btn btn-info" value="戻る">
          </form>
      </div>

    <?php else:?>

      <!-- エラー抽出 $page_flag0-->
    <?php if(!empty($error)):?>
      <ul class="error_list" 
          style="padding: 10px 30px;
          color: #ff2e5a;
          font-size: 86%;
          text-align: left;
          border: 1px solid #ff2e5a;
          border-radius: 5px;">
    <?php foreach($error as $value):?>
        <li><?php echo $value;?></li>
    <?php endforeach; ?>
      </ul>
    <?php endif?>


    <!-- 会員登録画面 $page_flag0 -->
    <div class="d-flex justify-content-center h-100">


        <form action="/CodeIgniterform/form/validation" method="post" class="form">
          
          <div class="form-group element_wrap">
            <p>名前 <input type="text" name="name" id="focusedInput" class="form-control" placeholder="名前"></p>
            <p>カナ <input type="text" name="kana" id="focusedInput" class="form-control" placeholder="カナ"></p>
            <p>電話 <input type="text" name="tel" id="focusedInput" class="form-control" placeholder="ハイフンなし"></p>
            <p>mail <input type="text" name="mail" id="focusedInput" class="form-control" placeholder="xxxxx@icloud.com"></p>
            <p>pass <input type="text" name="pass" id="focusedInput" class="form-control" placeholder="英数字６桁"></p>
            <p>生まれ年
              <select name="year" class="form-control">
                <?php
          for($number = 1900; $number <= date('Y'); $number++){
            echo '<option value="'.$number . '">' . $number . '</option>';
          }
          ?> 
          </select>
        </p>
        <p>性別
          <label class="form-control" name="sex">
            <input type="radio" name="sex" value= "男性" checked>男性
            <input type="radio" name="sex" value= "女性">女性
          </label>
        </p>
        <p>メールマガジン送付
          <input type="hidden" name="magagine" value= "0">
          <input type="checkbox" name="magagine" value= "1"></p>

        <input type="submit" class="btn btn-success" name="btn_confirm" value="書き込む">
      </form>
    </div>
    
    <?php endif; ?>
  </body>
  </html>