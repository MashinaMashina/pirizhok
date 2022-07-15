
function getPositions() {
    let positions = []
    document.querySelectorAll('.js-menu-item').forEach(function (position) {
        let count = position.querySelector('.js-item-count').value

        if (count > 0) {
            let name = position.querySelector('.js-item-name').textContent
            let measure = position.querySelector('.js-item-measure').textContent
            let price = parseFloat(position.querySelector('.js-item-price').textContent)
            let text = num_word(count, ['порция', 'порции', 'порций'])
            let groupName = position.querySelector('.js-item-name').getAttribute('data-group')

            positions.push({
                name: name.trim(),
                count: parseInt(count) || 0,
                text: text,
                price: price,
                measure: measure.trim(),
                group_name: groupName,
            })
        }
    })

    return positions
}

function recalculateCart() {
    let positions = getPositions()

    if (positions.length === 0) {
        document.querySelector('.js-cart-count').innerHTML = 'В корзине нет позиций'
        return
    }

    let count = 0
    for (let i in positions) {
        count += positions[i].count
    }

    document.querySelector('.js-cart-count').innerHTML =
        'В корзине ' + count + ' ' + num_word(count, ['позиция', 'позиции', 'позиций'])
}

document.addEventListener("DOMContentLoaded", function () {
    let username = localStorage.getItem("username")

    if (typeof username != "undefined" && username != null) {
        document.querySelector('#username').value = username
    }

    document.querySelector('#username').addEventListener('keyup', function () {
        localStorage.setItem('username', this.value)
    })

    document.querySelector('.js-open-cart').addEventListener('click', function () {
        let positions = getPositions()
        let positionsStr = ''
        for (let i in positions) {
            positionsStr += `<li class="js-cart-position">${positions[i].name} ${positions[i].count} ${positions[i].text}</li>`
        }

        let confirmBtn = document.querySelector('.js-cart-confirm')
        if (positionsStr.length > 0) {
            positionsStr = `<span class="fw-bold">Позиции заказа:</span><ol>${positionsStr}</ol>`
            document.querySelector('.js-cart-positions').innerHTML = positionsStr

            confirmBtn.disabled = false
        } else {
            document.querySelector('.js-cart-positions').innerHTML = `<b>Заказ пустой</b>`

            confirmBtn.disabled = true
        }

    })

    document.querySelectorAll('.js-to-cart').forEach(function (element) {
      element.addEventListener('click', function () {
          let counter = this.closest('.js-menu-item').querySelector(".js-item-count")
          let lastVal = parseInt(counter.value) || 0
          counter.value = lastVal+1

          recalculateCart()
      })
    })

    document.querySelectorAll('.js-item-count').forEach(function (element) {
      element.addEventListener('keyup', function () {
          if (this.value < 1) {
              this.value = 0
          }

          recalculateCart()
      })
      element.addEventListener('change', function () {
          if (this.value < 1) {
              this.value = 0
          }

          recalculateCart()
      })
    })

    document.querySelector('.js-cart-confirm').addEventListener('click', function () {
        if (this.disabled) {
            return
        }

        let orderModal = bootstrap.Modal.getInstance(document.getElementById('orderModal'));
        let successModal = new bootstrap.Modal(document.getElementById('successModal'));
        
        let positions = getPositions();
        let username = document.querySelector('#username').value;

        let form = new FormData();
        form.append('csrf', csrf);
        form.append('companyId', companyId);
        form.append('positions', JSON.stringify(positions));
        form.append('username', username);
        form.append('menu_id', menuId);

        fetch('/order/create/', {
            method: 'POST',
            body: form
        })
        .then((res) => res.json())
        .then((data) => {
            if(!data.success){
                alert(data.message);
            }
            else {
                let fields = document.querySelectorAll('.js-item-count');
                fields.forEach(field => {
                    field.value = 0;
                });
                orderModal.hide();
                successModal.show();

                recalculateCart();
            }
        })
    })
})

