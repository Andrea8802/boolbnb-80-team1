import { loadStripe } from '@stripe/stripe-js'
import { defineComponent, ref, onBeforeMount } from 'vue'

export default defineComponent({
    // ...
    setup() {
        onBeforeMount(() => {
            const stripeLoaded = ref(false)
            const stripePromise = loadStripe('your_key')
            stripePromise.then(() => {
                stripeLoaded.value = true
            })
        })
    },
})