import Crypt from 'crypto-js'

const token = sessionStorage.getItem('token')
let user = null
if (token != null) {
  const bytes = Crypt.AES.decrypt(token, '123')
  user = JSON.parse(bytes.toString(Crypt.enc.Utf8))
}

export default user
