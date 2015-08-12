<div class="menu" name="menu">
    <div class="men">
        <table>
        <tr><td><a href="?section=search-movie-form"><div class ="men-td">Recherche</div></a></td></tr>
        <tr><td><div class ="men-td"><a href="?section=affiche-chanteur-liste">chanteur</a></td></div></tr>
        <tr><td><div class ="men-td"><a href="?section=affiche-album-liste">album</a></td></div></tr>
        <tr><td><div class ="men-td"><a href="?section=affiche-chanson-liste">chansons</a></td></div></tr>
        <tr><td><div class ="men-td"><a href="?section=affiche-genre-liste">genre</a></td></div></tr>
        <tr><td><div class ="men-td"><a href="?section=affiche-label-liste">label</a></td></div></tr>
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

