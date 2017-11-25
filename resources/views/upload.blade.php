<form action="{{ route('upload.userAvatar') }}" method="post" enctype="multipart/form-data">
    <fieldset>
        <legend>Ảnh đại diện:</legend>
        {{ csrf_field() }}
        <input type="file" name="user_avatar"><br>
        <input type="submit" value="Tải lên" name="submit">
    </fieldset>
</form>
<hr>
<form action="{{ route('upload.productImage') }}" method="post" enctype="multipart/form-data">
    <fieldset>
        <legend>Ảnh sản phẩm:</legend>
        {{ csrf_field() }}
        <input type="file" name="product_image"><br>
        <input type="submit" value="Tải lên" name="submit">
    </fieldset>
</form>