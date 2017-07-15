(function (root, name, definition) {
  if (typeof module !== 'undefined' && module.exports) {
    module.exports = definition
  } else {
    root[name] = definition
  }
}(this, 'detectOS', function () {
  var mathTan = Math.tan(-1e300)

  if (mathTan === -1.4214488238747245) {
    return 'Linux 64'
  } else if (mathTan === 0.8831488831618285) {
    return 'Linux 32'
  } else if (mathTan === -4.987183803371025) {
    return 'Windows'
  } else {
    return 'Mac OS X'
  }
}))
