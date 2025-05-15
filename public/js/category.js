console.log('category loaded');

document.getElementById("catag").addEventListener("change", function () {
  const url = this.value;
  if (url) {
    window.location.href = url;
  }
});
