let cart = JSON.parse(localStorage.getItem("cart")) || []

const table = document.getElementById("cartTable");

cart.forEach((item,index) => {
    const row = document.createElement("tr");

    row.innerHTML = `
        <td><img src="${item.image}" alt="${item.title}" width="60"></td>
        <td>${item.title}</td>
        <td>${item.price}</td>
        <td><input type="number" value="${item.qty}" data-index="${index}"></td>
        <td>${item.price * item.qty} </td>
        <td><button data-index="${index}">Remove </button></td>
    `;

    table.appendChild(row);
});

const total = cart.reduce((sum, item) => sum + item.price * item.qty, 0);
document.getElementById("total").textContent = `Total: $${total.toFixed(2)}`;


document.querySelectorAll("button").forEach(button => {

    button.addEventListener("click", event => {

        const index = event.target.dataset.index;

        cart.splice(index, 1); // Number of elements will remove, 1 yerine 2 yapsak hem seçtiğimizi, hem de ondan sonra ilk gelen şey siler.

        localStorage.setItem("cart", JSON.stringify(cart)); //Sildikten sonra saveliyoruz

        location.reload(); //En son güncelliyoruz   

    });

});


document.querySelectorAll("input[type='number']").forEach(input => {

    input.addEventListener("change", event => {

        const index = event.target.dataset.index;

        const newQty = Number(event.target.value);

        cart[index].qty = newQty;

        localStorage.setItem("cart", JSON.stringify(cart));

        location.reload();

    });

});