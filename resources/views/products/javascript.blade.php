<script>
    // chechbox for stock
    document.addEventListener("DOMContentLoaded", function() {
        const minusBtn = document.getElementById("minus-btn");
        const plusBtn = document.getElementById("plus-btn");
        const valueSpan = document.querySelector(".input-value");
        const hiddenStockInput = document.getElementById("hidden-stock");

        let value = parseInt(hiddenStockInput.value) || 1;
        valueSpan.textContent = value;

        minusBtn.addEventListener("click", function() {
            if (value > 0) {
                value--;
                valueSpan.textContent = value;
                hiddenStockInput.value = value; 
            }
        });

    plusBtn.addEventListener("click", function() {
            value++;
            valueSpan.textContent = value;
            hiddenStockInput.value = value;
        });
    });


    // Checkbox for colors
    document.addEventListener("DOMContentLoaded", function() {
        const addCheckboxButton = document.getElementById('add-checkbox');
        const newValueInput = document.getElementById('new-value-input');

            addCheckboxButton.addEventListener('click', function() {
                newValueInput.style.display = 'block';
            });
        });

    document.addEventListener('DOMContentLoaded', function() {
        const colorLabels = document.querySelectorAll('.color-label');

        colorLabels.forEach(function(label) {
            label.addEventListener('click', function() {
                this.classList.toggle('selected');
            });
        });
    });


    // checkbox for sizes 
    document.addEventListener('DOMContentLoaded', function() {
        const addButton = document.getElementById('add-size-btn');
        const sizeCheckboxes = document.getElementById('size-checkboxes');
        const sizeContainer = document.getElementById('size-checkboxes');

        addButton.addEventListener('click', function() {
            const newSizeName = prompt('Enter the name of the new size:');
            if (newSizeName) {
                const newCheckbox = document.createElement('input');
                newCheckbox.type = 'checkbox';
                newCheckbox.className = 'checkbox visually-hidden';
                newCheckbox.value = newSizeName;
                newCheckbox.name = 'sizes[]';

                const newLabel = document.createElement('label');
                newLabel.htmlFor = 'size' + newSizeName;
                newLabel.className = 'checkbox-label';
                newLabel.textContent = newSizeName;

                newLabel.addEventListener('click', function() {
                    newCheckbox.checked = !newCheckbox.checked;
                });

                sizeCheckboxes.appendChild(newCheckbox);
                sizeCheckboxes.appendChild(newLabel);

                sizeContainer.insertBefore(newCheckbox, addButton);
                sizeContainer.insertBefore(newLabel, addButton);

                sizeCheckboxes.appendChild(document.createElement('br'));
            }
        });
    });

    // dellete images
    document.addEventListener("DOMContentLoaded", function() {
        var deleteImages = document.querySelectorAll('.delete-image');

        deleteImages.forEach(function(image) {
            image.addEventListener('click', function(event) {
                event.preventDefault();
                
                var confirmDelete = confirm('Are you sure you want to remove this image?');
                if (confirmDelete) {
                    this.parentNode.removeChild(this);
                }
            });
        });
    });
</script>