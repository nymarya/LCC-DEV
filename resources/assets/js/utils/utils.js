export function getJSON (url) {
    var request = new window.XMLHttpRequest()
    var data = {}
    // p (-simulated- promise)
    var p = {
        then (fn1, fn2) { return p.done(fn1).fail(fn2) },
        catch (fn) { return p.fail(fn) },
        always (fn) { return p.done(fn).fail(fn) }
    };
    ['done', 'fail'].forEach(name => {
        data[name] = []
        p[name] = (fn) => {
            if (fn instanceof Function) data[name].push(fn)
            return p
        }
    })
    p.done(JSON.parse)
    request.onreadystatechange = () => {
        if (request.readyState === 4) {
            let e = {status: request.status}
            if (request.status === 200) {
                try {
                    var response = request.responseText
                    for (var i in data.done) {
                        var value = data.done[i](response)
                        if (value !== undefined) { response = value }
                    }
                } catch (err) {
                    data.fail.forEach(fail => fail(err))
                }
            } else {
                data.fail.forEach(fail => fail(e))
            }
        }
    }
    request.open('GET', url)
    request.setRequestHeader('Accept', 'application/json')
    request.send()
    return p
}

export function delayer (fn, varTimer, ifNaN = 100) {
    function toInt (el) { return /^[0-9]+$/.test(el) ? Number(el) || 1 : null }
    var timerId
    return function (...args) {
        if (timerId) clearTimeout(timerId)
        timerId = setTimeout(() => {
            fn.apply(this, args)
        }, toInt(varTimer) || toInt(this[varTimer]) || ifNaN)
    }
}