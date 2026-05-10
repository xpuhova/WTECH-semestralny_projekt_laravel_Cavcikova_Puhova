document.addEventListener('DOMContentLoaded', function () {
    let isInitial = true;
    let allNewImages = [];
    const discountInput = document.getElementById('productDiscount');
    const saleCheckbox = document.querySelector('.btn-check[data-name="Sale"]');
    const priceInput = document.getElementById('productPrice');

    function checkImageCount() {
        const imageCount = document.querySelectorAll('.remove-button:not(:checked)').length;

        if (imageCount < 2) {
            document.getElementById('confirm-button').disabled = true;
        } else {
            document.getElementById('confirm-button').disabled = false;
        }
    }
    function updateSizes(categoryName) {
        const adultShoeSizes = document.getElementById('adult-shoe-sizes');
        const adultClothingSizes = document.getElementById('adult-clothing-sizes');
        const kidsShoeSizes = document.getElementById('kids-shoe-sizes');
        const kidsClothingSizes = document.getElementById('kids-clothing-sizes');

        const allSizeGroups = [
            adultShoeSizes,
            kidsShoeSizes,
            adultClothingSizes,
            kidsClothingSizes
        ];

        allSizeGroups.forEach(group => {
            group.classList.add('d-none');
        });

        const checkedAudiences = document.querySelectorAll('.audience-tag:checked');
        let hasAdultAudience = false;
        let hasKidsAudience = false;

        checkedAudiences.forEach(audience => {
            const name = audience.dataset.name;

            if (name === 'Men' || name === 'Women') {
                hasAdultAudience = true;
            }
            if (name === 'Kids') {
                hasKidsAudience = true;
            }
        });

        const checkedSubcategory = document.querySelector('input[name="sub_category"]:checked');
        const subcategoryName = checkedSubcategory ? checkedSubcategory.dataset.name : null;
        const showClothing = categoryName === 'Clothing' || subcategoryName === 'Harnesses' || subcategoryName === 'Helmets';

        if (categoryName === 'Shoes') {
            if (hasKidsAudience) {
                kidsShoeSizes.classList.remove('d-none');
            }
            if (hasAdultAudience) {
                adultShoeSizes.classList.remove('d-none');
            }

        } else if (showClothing) {
            if (hasKidsAudience) {
                kidsClothingSizes.classList.remove('d-none');
            }
            if (hasAdultAudience) {
                adultClothingSizes.classList.remove('d-none');
            }
        }
    }

    if (priceInput) {
        priceInput.addEventListener('input', function () {
            const value = parseFloat(this.value);
            if (!isNaN(value)) {
                this.value = Math.floor(value * 100) / 100;
            }
        });

        priceInput.dispatchEvent(new Event('input'));
    }

    if (discountInput && saleCheckbox) {
        discountInput.addEventListener('input', function() {
            const value = parseFloat(this.value);

            if (this.value === '' || value === 0) {
                saleCheckbox.checked = false;
                saleCheckbox.disabled = true;
            }  else {
                saleCheckbox.disabled = false;
                saleCheckbox.checked = true;
            }
        });

        saleCheckbox.addEventListener('change', function() {
            if (!this.checked) {
                discountInput.value = 0;
                saleCheckbox.disabled = true;
            }
        });

        discountInput.dispatchEvent(new Event('input'));
    }

    document.querySelectorAll('input[name*="sort_order"]').forEach(order => {
        order.addEventListener('input', function (){
            const allOrders = Array.from(document.querySelectorAll('input[name*="sort_order"]')).map(function(order) {
                    return order.value;
                }).filter(function(value) {
                    return value !== '';
                });
            const duplicates = allOrders.length !== new Set(allOrders).size;

            if (duplicates) {
                alert('Multiple images have the same sort order. Sort order must be unique.');
                document.getElementById('confirm-button').disabled = true;
            } else {
                document.getElementById('confirm-button').disabled = false;
            }
        });
    });

    document.querySelectorAll('.parent-category').forEach(radio => {
        radio.addEventListener('change', function () {

            document.querySelectorAll('.subcategory-group').forEach(group => {
                group.classList.add('d-none');

                if (!isInitial) {
                    const allSizeGroups = [
                        document.getElementById('adult-shoe-sizes'),
                        document.getElementById('kids-shoe-sizes'),
                        document.getElementById('adult-clothing-sizes'),
                        document.getElementById('kids-clothing-sizes')
                    ];
                    allSizeGroups.forEach(function(group) {
                        group.querySelectorAll('input').forEach(function(input) {
                            input.checked = false;
                        });
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

            updateSizes(this.dataset.name);

            isInitial = false;
        });
    });

    document.querySelectorAll('.subcategory-group').forEach(subcategory => {
        subcategory.addEventListener('change', function() {
            const checkedCategory = document.querySelector('.parent-category:checked');
            if (checkedCategory) {
                updateSizes(checkedCategory.dataset.name);
            }
        });
    })

    document.querySelectorAll('.audience-tag').forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            const checkedCategory = document.querySelector('.parent-category:checked');
            if (checkedCategory) {
                updateSizes(checkedCategory.dataset.name);
            }
        });
    });

    const checked = document.querySelector('.parent-category:checked');

    if (checked) {
        checked.dispatchEvent(new Event('change'));
    }

    checkImageCount();

    document.getElementById('image-container').addEventListener('change', function(remove) {
        if (remove.target.classList.contains('remove-button')) {
            checkImageCount();
        }
    });

    document.getElementById('images').addEventListener('change', function(){
        const container = document.getElementById('image-container');

        Array.from(this.files).forEach(function(file){
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
                    <input type="checkbox" name="remove_new_images[]" class="btn-check remove-button" id="new_images[${imageIndex}]" value="${imageIndex}" autocomplete="off">
                    <label for="new_images[${imageIndex}]" class="btn btn-outline-dark">Remove</label>
                `;
                container.appendChild(div);
                checkImageCount();
            };
            reader.readAsDataURL(file);

        });
        const dataTransfer = new DataTransfer();
        allNewImages.forEach(function (imageFile){
            dataTransfer.items.add(imageFile);
        });
        this.files = dataTransfer.files;
        checkImageCount();
    });
});
