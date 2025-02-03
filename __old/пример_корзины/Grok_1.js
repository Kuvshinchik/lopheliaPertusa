// Function to save data to localStorage
function saveToDumpster(key, value) {
    // Convert the value to a string before storing
    localStorage.setItem(key, JSON.stringify(value));
    console.log(`Saved ${key} to dumpster`);
}

// Function to retrieve data from localStorage
function getFromDumpster(key) {
    const item = localStorage.getItem(key);
    return item ? JSON.parse(item) : null; // Parse back to original data type if possible
}

// Function to clear all items from dumpster (localStorage)
function clearDumpster() {
    localStorage.clear();
    console.log('Dumpster cleared');
}

// Example usage:
saveToDumpster('tempData', {name: 'John Doe', age: 30});
console.log(getFromDumpster('tempData')); // Should output {name: "John Doe", age: 30}

// Clear the dumpster
clearDumpster();

// Try to get data after clearing
console.log(getFromDumpster('tempData')); // Should output null

/*
Пояснение: 
saveToDumpster: 
Эта функция принимает ключ и значение. 
Она преобразует значение в строку JSON, поскольку localStorage принимает только строковые значения. 
getFromDumpster: 
Эта функция извлекает данные, связанные с заданным ключом, перефразируя их из JSON в исходный тип данных. 
clearDumpster: 
Очищает все данные из localStorage, что в данной метафоре представляет собой опустошение "мусорного контейнера". В этом подходе используется localStorage, который сохраняет данные даже после закрытия браузера. Если вам нужно, чтобы данные были действительно временными (т. е. доступными только для текущей сессии), то вместо них следует использовать sessionStorage, который имеет аналогичный API, но данные теряются при закрытии вкладки. Помните, что и localStorage, и sessionStorage имеют ограничения по размеру хранилища (обычно около 5-10 МБ на домен).
*/