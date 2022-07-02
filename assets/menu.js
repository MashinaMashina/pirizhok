function num_word(value, words){
    value = Math.abs(value) % 100;
    var num = value % 10;
    if(value > 10 && value < 20) return words[2];
    if(num > 1 && num < 5) return words[1];
    if(num === 1) return words[0];
    return words[2];
}

function getPositions() {
    let positions = []
    document.querySelectorAll('.js-menu-item').forEach(function (position) {
        let count = position.querySelector('.js-item-count').value

        if (count > 0) {
            let name = position.querySelector('.js-item-name').textContent
            let measure = position.querySelector('.js-item-measure').textContent
            let price = parseFloat(position.querySelector('.js-item-price').textContent)
            let text = num_word(count, ['порция', 'порции', 'порций'])

            positions.push({
                name: name.trim(),
                count: parseInt(count) || 0,
                text: text,
                price: price,
                measure: measure.trim(),
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

        let positions = ''

    })
})

