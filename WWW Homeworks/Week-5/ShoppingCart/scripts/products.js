fetch("https://fakestoreapi.com/products")
  .then(response => response.json()) // JSON verisine dönüştür
  .then(products => { // Veri geldikten sonra burası çalışır
    const table = document.getElementById("productTable");

    // Gelen ürünler (products) üzerinde döngü kuruyoruz
    products.forEach(product => {
        console.log(products);
      const row = document.createElement("tr");

      //String interpolation (${variable}) koyacaksan ters tırnak içerisine alacaksın `
      row.innerHTML = ` 
        <td>
          <a href="details.html?id=${product.id}">
            ${product.title}
          </a>
        </td>
        <td>$${product.price}</td>
      `;

      table.appendChild(row);
    });
  })
  .catch(error => console.error("Veri çekilirken hata oluştu:", error));