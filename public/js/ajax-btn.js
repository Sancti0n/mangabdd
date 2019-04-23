function onClickBtnOwned(event) {
    event.preventDefault();

    const url = this.href;
    const icone = this.querySelector("span");

    axios.get(url).then(function (response) {
      if(icone.classList.contains("icon-plus-circle")) {
        icone.classList.replace("icon-plus-circle", "icon-check-circle");
      }
      else {
        icone.classList.replace("icon-check-circle", "icon-plus-circle");
      }
    })
  }

  document.querySelectorAll("a.js-owned").forEach(function(link) {
    link.addEventListener("click", onClickBtnOwned);
  });