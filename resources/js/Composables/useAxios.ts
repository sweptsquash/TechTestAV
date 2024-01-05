import axios, { Axios } from 'axios'

export default (): Axios => {
    return axios.create({
        headers: { 'X-Requested-With': 'XMLHttpRequest' },
        withCredentials: true,
    })
}
