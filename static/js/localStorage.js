
export function addToLocalStorage(value, key) {
    if (isInLocalStorage(value, key))
        return;

    var currentItems = getFromLocalStorage(key);
    currentItems.push(value);
    localStorage.setItem(key, JSON.stringify(currentItems));
}

export function removeFromLocalStorage(value, key) {
    var currentItems = getFromLocalStorage(key);
    const index = currentItems.indexOf(value);
    if (index > -1)
        currentItems.splice(index, 1);

    localStorage.setItem(key, JSON.stringify(currentItems));
}

export function getFromLocalStorage(key) {
    var array = JSON.parse(localStorage.getItem(key))
    if (!array)
        array = []

    return array;
}

export function isInLocalStorage(value, key) {
    const values = getFromLocalStorage(key);
    return values.includes(value);
}
