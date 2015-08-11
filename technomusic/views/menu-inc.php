<div class="menu" name="menu">
    <div class="men">
        <table>
        <tr><td><div class ="men-td"><a href="?section=search-movie-form">Recherche</a></div></td></tr>
        <tr><td><div class ="men-td"><a href="?section=search-movie-form">chanteur</a></td></div></tr>
        <tr><td><div class ="men-td"><a href="?section=search-movie-form">album</a></td></div></tr>
        <tr><td><div class ="men-td"><a href="?section=search-movie-form">chansons</a></td></div></tr>
        <tr><td><div class ="men-td"><a href="?section=search-movie-form">genre</a></td></div></tr>
        <tr><td><div class ="men-td"><a href="?section=search-movie-form">label</a></td></div></tr>
    </table>
    </div>
</div>
<script>
var positionElementInPage = $('menu').offset().top;
$(window).scroll(
function() {
if ($(window).scrollTop() &gt;= positionElementInPage) {
// fixed
$('menu').addClass("floatable");
} else {
// relative
$('menu').removeClass("floatable");
}
}
)
</script>

