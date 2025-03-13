<!DOCTYPE html>
<html>
@include('welcome.head')

<body>
    <div class="header_section">
        <!-- header section start -->
        @include('welcome.header')
        <!-- header section end -->
        <!-- banner section start -->
        @include('welcome.banner')
        <!-- banner section end -->
    </div>
    <!-- header section end -->
    <!-- coffee section start -->
    @include('welcome.boutique')
    <!-- coffee section end -->
    <!-- about section start -->
    @include('welcome.about')
    <!-- about section end -->
    <!-- client section start -->
    @include('welcome.client')
    <!-- client section end -->
    <!-- blog section start -->
    @include('welcome.blog')
    <!-- blog section end -->
    <!-- contact section start -->
    @include('welcome.contact')
    <!-- contact section end -->
    <!-- footer section start -->
    @include('welcome.footer')
    <!-- footer section end -->
    <!-- copyright section start -->
    @include('welcome.copyright')
    <!-- copyright section end -->
    @include('welcome.js')
</body>

</html>
