['touchstart', 'mouseover'].forEach(function (eventName) {
    document.getElementById('starContainer').addEventListener(
        eventName,
        function (e) {
            if (e.target.classList.contains('star')) {
                document.getElementById('testimony_rate').value =
                    e.target.dataset.value;
                document
                    .getElementById('starContainer')
                    .querySelectorAll('.star')
                    .forEach(function (star, index) {
                        if (index + 1 <= e.target.dataset.value) {
                            star.classList.add('fas');
                            star.classList.remove('far');
                        } else {
                            star.classList.add('far');
                            star.classList.remove('fas');
                        }
                    });
            }
        },
        false
    );
});