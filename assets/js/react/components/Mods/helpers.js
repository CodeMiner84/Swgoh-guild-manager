const getShortMod = (text) => {
  const splitted = text.split(' ')
  if (splitted.length === 1) {
    return text.slice(0, 2)
  }
  return splitted.reduce((previous, current) => previous.slice(0, 1) + current.slice(0, 1))
}

export default {
  getShortMod,
}
