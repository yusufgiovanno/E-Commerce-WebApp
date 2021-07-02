<!DOCTYPE html>
<html>
<head>
    <?php include 'head.php'; ?>
</head>

<body class="pt-5" style="min-height:90vh">

<div class="container">
  <h3>Example of <a href="https://github.com/ttskch/select2-bootstrap4-theme" target="_blank">@ttskch/select2-bootstrap4-theme</a></h3>
  <hr>

  <form>
    <div class="form-group">
      <label>Example of select</label>
      <select placeholder="Choose one thing" data-allow-clear="1">
        <option></option>
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
      </select>
    </div>
    <div class="form-group">
      <label>Example of multiple select</label>
      <select multiple placeholder="Choose anything" data-allow-clear="1">
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
      </select>
    </div>
    <div class="form-group">
      <label>Example of disabled select</label>
      <select disabled placeholder="Cannot choose">
      </select>
    </div>
    <div class="form-group">
      <label>Example of select with optgroup</label>
      <select placeholder="Choose one thing">
        <option></option>
        <optgroup label="Group A">
          <option>A1</option>
          <option>A2</option>
          <option>A3</option>
        </optgroup>
        <optgroup label="Group B">
          <option>B1</option>
          <option>B2</option>
          <option>B3</option>
        </optgroup>
      </select>
    </div>
    <div class="form-group">
      <label>Example of input-group</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">Prepend</span>
        </div>
        <select placeholder="Choose on thing">
          <option></option>
          <option>1</option>
          <option>2</option>
          <option>3</option>
        </select>
      </div>
      <div class="input-group mt-2">
        <select placeholder="Choose on thing">
          <option></option>
          <option>1</option>
          <option>2</option>
          <option>3</option>
        </select>
        <div class="input-group-append">
          <span class="input-group-text">Append</span>
        </div>
      </div>
      <div class="input-group mt-2">
        <div class="input-group-prepend">
          <span class="input-group-text">Prepend</span>
        </div>
        <select placeholder="Choose on thing">
          <option></option>
          <option>1</option>
          <option>2</option>
          <option>3</option>
        </select>
        <div class="input-group-append">
          <span class="input-group-text">Append</span>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label>Example of validated select</label>
      <select placeholder="Invalid example" class="form-control is-invalid">
        <option></option>
      </select>
      <div class="invalid-feedback">
        Something is wrong.
      </div>
    </div>
  </form>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
