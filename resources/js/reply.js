const reply_btns = document.querySelectorAll(".reply_btn");

reply_btns.forEach((btn) => {
    btn.addEventListener("click", () => {
        btn.nextElementSibling.classList.toggle("d-none");
    });
});
