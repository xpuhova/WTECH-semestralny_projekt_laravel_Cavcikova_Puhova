document.addEventListener('DOMContentLoaded', function () {
    let isInitial = true;

    document.querySelectorAll('.parent-category').forEach(radio => {
        radio.addEventListener('change', function () {

            document.querySelectorAll('.subcategory-group').forEach(group => {
                group.classList.add('d-none');

                if (!isInitial) {
                    group.querySelectorAll('input').forEach(input => {
                        input.checked = false;
                    });
                }
            });

            const group = document.querySelector(
                `.subcategory-group[data-parent="${this.value}"]`
            );

            if (group) {
                group.classList.remove('d-none');
                group.classList.add('d-flex', 'gap-3', 'flex-wrap');
            }

            const categoryName = this.dataset.name;
            const shoeSizes = document.getElementById('shoe-sizes');
            const clothingSizes = document.getElementById('clothing-sizes');

            shoeSizes.classList.add('d-none');
            clothingSizes.classList.add('d-none');

            if (!isInitial) {
                shoeSizes.querySelectorAll('input').forEach(function(input) {
                    input.checked = false;
                });
                clothingSizes.querySelectorAll('input').forEach(function(input) {
                    input.checked = false;
                });
            }

            if (categoryName === 'Shoes') {
                shoeSizes.classList.remove('d-none');
            } else if (categoryName === 'Clothing') {
                clothingSizes.classList.remove('d-none');
            }

            isInitial = false;
        });
    });

    const checked = document.querySelector('.parent-category:checked');

    if (checked) {
        checked.dispatchEvent(new Event('change'));
    }
});
