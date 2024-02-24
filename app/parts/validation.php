<!-- バリデーションのエラー文を出力 -->
  <?php if(isset($error)): ?>
  <ul class="errorMsg">
    <?php foreach($error as $errors): ?>
    <li><?php echo $errors ?></li>
    <?php endforeach ?>
  </ul>
  <?php endif; ?>