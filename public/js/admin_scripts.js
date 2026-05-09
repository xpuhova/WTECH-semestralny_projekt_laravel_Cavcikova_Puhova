document.addEventListener('DOMContentLoaded', function () {
    let isInitial = true;
    let allNewImages = [];

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

    document.getElementById('images').addEventListener('change', function(){
        const container = document.getElementById('image-container');

        Array.from(this.files).forEach(function(file, index){
            const reader = new FileReader();
            const imageIndex = allNewImages.length;
            allNewImages.push(file);

            reader.onload = function(image){
                const div = document.createElement('div');
                div.classList.add('image-item', 'flex-column', 'd-flex', 'gap-2', 'new-image-preview');
                div.innerHTML = `
                    <img src="${image.target.result}" class="img-manage">

                    <input type="text" name="new_images[${imageIndex}][alt_text]" class="form-control" placeholder="alt text" required>
                    <input type="number" name="new_images[${imageIndex}][sort_order]" class="form-control" placeholder="sort order" required>
                    <input type="checkbox" class="btn-check" id="new_images[${imageIndex}]" value="${image.target.result}" autocomplete="off">
                    <label for="new_images[${imageIndex}]" class="btn btn-outline-dark">Remove</label>
                `;
                container.appendChild(div);
            };
            reader.readAsDataURL(file);

        });
        const dataTransfer = new DataTransfer();
        allNewImages.forEach(function (imageFile){
            dataTransfer.items.add(imageFile);
        });
        this.files = dataTransfer.files;
    });
});
