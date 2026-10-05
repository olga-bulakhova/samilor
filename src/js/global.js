import './global/menu'
import './global/slick-slider'
import './global/minicart'
import './global/drop-down'
import './global/toggle-reviews-form'
import './global/cart'
//import './global/form-validator'
//import './global/add-cart-massage'
import './global/add-cart-loader'

async function retryPromise(fn, retries, delay) {
	if (retries <= 0) return

	try {
		setTimeout(() => {
			fn()
		}, delay)
	} catch (e) {
		return retryPromise(fn, retries - 1, delay)
	}

	return retryPromise(fn, retries - 1, delay)
}

let attCount = 0

function unsTask() {
	return new Promise((resolve, reject) => {
		attCount++
		console.log(`Попытка ${attCount}`)
		if (attCount < 3) {
			reject(`Ошибка на попытке ${attCount}`)
		} else {
			resolve(`Успех на попытке ${attCount}`)
		}
	})
}

retryPromise(unsTask, 5, 1000)
	.then(res => console.log(res))
	.catch(err => console.log(err))
