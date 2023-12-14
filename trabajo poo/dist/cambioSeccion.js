document.addEventListener('DOMContentLoaded', function () {
    const sideMenuItems = document.querySelectorAll('.side-menu a');

    sideMenuItems.forEach(function (item) {
        item.addEventListener('click', function (event) {
            event.preventDefault();
            const targetSectionId = this.getAttribute('href').substring(1);
            const targetSection = document.getElementById(targetSectionId);

            const mainSections = document.querySelectorAll('main > div');
            mainSections.forEach(function (section) {
                section.style.display = 'none';
            });

            targetSection.style.display = 'block';
        });
    });
});
