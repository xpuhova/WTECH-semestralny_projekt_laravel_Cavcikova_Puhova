function changeQuantity(change){
    const input = document.getElementById('quantity');
    let value = parseInt(input.value);
    value = value + change;
    value = Math.max(1,value);
    input.value = value;
}
