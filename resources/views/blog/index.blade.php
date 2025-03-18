<!DOCTYPE html>
<html>

@include('welcome.head')

<body>
    @include('blog.header')
    <!-- header section end -->
    <!-- blog section start -->
    @include('blog.blog')
    <!-- blog section end -->
    <!-- footer section start -->
    @include('welcome.footer')
    <!-- footer section end -->
    <!-- copyright section start -->
    @include('welcome.copyright')
    <!-- copyright section end -->
    <!-- Javascript files-->
    @include('welcome.js')
</body>

</html>
