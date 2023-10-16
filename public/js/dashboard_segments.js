const menuItems = document.querySelectorAll(".sidebar-menu__link");

const navItems = document.querySelectorAll(".nav-item");

menuItems.forEach(menuItem => {
    menuItem.addEventListener("click", e => {
        if (!e.target.classList.contains("active")) {
            document.
            querySelector(".sidebar-menu__link.active").
            classList.remove("active");
            e.target.classList.add("active");
        }
    });
});

navItems.forEach(navItem => {
    navItem.addEventListener("click", e => {
        if (!e.target.classList.contains("active")) {
            document.querySelector(".nav-item.active").classList.remove("active");
            e.target.classList.add("active");
        }
    });
});

const cards = document.querySelectorAll(".card");
const mainContent = document.querySelector(".main-content");

cards.forEach(card => {
    card.addEventListener("click", () => {

        document.startViewTransition(() => {
            if (!card.classList.contains('active')) {
                mainContent.classList.add("expanded");
                card.classList.add("active");
                card.classList.toggle('card-img');
                const date = card.getElementsByClassName('diary-date')[0];
                const content = card.getElementsByClassName('segment-content')[0];

                // console.log(editor.height);
                const content2 = card.getElementsByClassName('segment-content')[0];

                date.classList.toggle('hidden');
                content.classList.toggle('hidden');
                // const content = document.getElementsByClassName('segment-content')[0];
                // console.log(content.textContent);
                // content.classList.toggle('hidden');
            } else {
                card.classList.remove("active");
                mainContent.classList.remove("expanded");
                card.classList.toggle('card-img');
                const date = card.getElementsByClassName('diary-date')[0];
                const content = card.getElementsByClassName('segment-content')[0];
                date.classList.toggle('hidden');
                content.classList.toggle('hidden');
            }
        });
    });
});
