<div class="menu" name="menu">
    <div class="men">
        <table>
        <tr><td><div class ="men-td"><a href="?section=search-movie-form">Recherche</a></div></td></tr>
        <tr><td><div class ="men-td"><a href="views/chanteur-liste.inc.php">chanteur</a></td></div></tr>
        <tr><td><div class ="men-td"><a href="views/album-liste.inc.php">album</a></td></div></tr>
        <tr><td><div class ="men-td"><a href="views/chanson-liste.inc.php">chansons</a></td></div></tr>
        <tr><td><div class ="men-td"><a href="views/genre-liste.inc.php">genre</a></td></div></tr>
        <tr><td><div class ="men-td"><a href="views/label-liste.inc.php">label</a></td></div></tr>
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

