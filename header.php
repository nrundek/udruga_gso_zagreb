<link rel="stylesheet" href="rundekstil.css">
<header>
     <center>
      <button class="gumb" id="increase-font-size">
        + Povećaj font
      </button>
      <button class="gumb" id="decrease-font-size">
        - Smanji font
      </button>
    </center>
    <script>
var increaseFontSizeBtn = document.getElementById("increase-font-size");
var decreaseFontSizeBtn = document.getElementById("decrease-font-size");
var allElements = document.getElementsByTagName("*");
var fontSize = parseInt(window.getComputedStyle(document.body).fontSize);
increaseFontSizeBtn.addEventListener("click", function() {
  fontSize += 2;
  for (var i = 0; i < allElements.length; i++) {
    var elementFontSize = parseInt(window.getComputedStyle(allElements[i]).fontSize);
    allElements[i].style.fontSize = (elementFontSize + 2) + "px";
  }
});

decreaseFontSizeBtn.addEventListener("click", function() {
  fontSize -= 2;
  for (var i = 0; i < allElements.length; i++) {
    var elementFontSize = parseInt(window.getComputedStyle(allElements[i]).fontSize);
    allElements[i].style.fontSize = (elementFontSize - 2) + "px";
  }
});
</script>
</header>

