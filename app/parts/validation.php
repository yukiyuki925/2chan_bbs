    <!-- バリデーションチェックのエラー文吐きだし -->
    <?php if (isset($error)) : ?>
    <ul class="errorMessage">
      <?php foreach ($error as $errors) : ?>
      <li><?php echo $errors ?></li>
      <?php endforeach; ?>
    </ul>
    <?php endif; ?>