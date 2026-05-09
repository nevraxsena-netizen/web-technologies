let params = new URLSearchParams(window.location.search); //document.location.search kısmı URL'deki ? işaretinden sonrasını (örneğin: ?id=5) alır.
//URLSearchParams ise bu karmaşık metni parçalara ayırıp içinden kolayca veri çekmemizi sağlayan bir araçtır.

let productId = Number(params.get("id"));

console.log(productId);

//...

const url = `https://fakestoreapi.com/products/${productId}`; 
let product = null;

// code for the requirements
fetch(url)
.then(response => response.json())
.then(data => {
    console.log(data);
    product = data;

    let div = document.getElementById("productDetails");
    div.innerHTML = `
        <h2>${data.title}</h2>
        <img src="${data.image}" alt="${data.title}" width="200">
        <p>${data.description}</p>
        <p>$${data.price}</p>

    `;
})

document.getElementById("addToCartBtn").addEventListener("click", () => {
    const qty = document.getElementById("quantity").value;

    let cart = JSON.parse(localStorage.getItem("cart")) || [];

    // TODO:
    // create a JSON object representing the product
    // add id, title, price, qty

    // example structure
    // {
    //   id: product.id,
    //   title: product.title,
    //   price: product.price,
    //   qty: qty
    // }

    const item = {
        id: product.id,
        title : product.title,
        price : product.price,
        qty : Number(qty),
        image: product.image
    }

    // TODO:
    // push the item into the cart array
    cart.push(item)


    // TODO:
    // save the cart into local storage
    localStorage.setItem("cart", JSON.stringify(cart)); //Object -> String yapıyor sanırım

    // TODO:
    // notify the user of successful operation using an alert
    alert(`The product ${product.title} has been added to the cart!`);

});