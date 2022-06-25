<form method="post" action="/any">
    @csrf
{{--    đối với tất cả các phương thức k phải get, option phải có token
=> thêm nó vào thì mới gọi dc phương thức khác
 --}}
   <div>
       <input type="text" placeholder="nhập username">
{{--        có thẻ custom (viết lại phương thức truyền khi submi--}}
        <input type="hidden" name="_method" value="PUT">

   </div>
    <button type="submit">submit</button>
</form>
<button><a href="<?php echo route('admin.product.add',['id'=>12])?>">gọi route</a></button>
