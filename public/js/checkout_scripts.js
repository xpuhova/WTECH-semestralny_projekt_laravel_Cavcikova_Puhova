function updateShippingCost() {
    const totalData = document.getElementById('total-data');
    const selected = document.querySelector('input[name="delivery"]:checked');
    if (!selected){
        return;
    }
    const price = parseFloat(selected.dataset.price);
    const subtotal = parseFloat(totalData.dataset.preDiscount);
    const total = parseFloat(totalData.dataset.postDiscount);

    document.getElementById('subtotal').textContent = (subtotal + price).toFixed(2) + '€';
    document.getElementById('total').textContent = (total + price).toFixed(2) + '€';
}
