<?php
$position = 0;

if(isset($_POST["submitButton"])) {
  $position = $_POST["position"];
}
?>

<form class="formWrapper" method="POST">
  <div>
    <input type="submit" value="書き込む" name="submitButton">
    <label>名前：</label>
    <input type="text" name="username">
    <input type="hidden" name="threadID" value="<?php echo $thread["id"]; ?>">
  </div>
  <div>
    <textarea class="commentTextArea" name="body"></textarea>
  </div>

  <!-- 位置取得 -->
  <input type="hidden" name="position" value="0">

</form>

<!-- jquery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
  integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
$(document).ready(() => {
  $("input[type=submit]").click(() => {
    // 現在のスクロール位置を取得
    let position = $(window).scrollTop();
    // valueにpositionの値を設定
    $("input:hidden[name=position]").val(position);
  })
  $(window).scrollTop(<?php echo $position; ?>);
})
</script>