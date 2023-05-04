import React from "react";
import ReactDOM from "react-dom/client";

import Btns from "./Actions/Btns";
import Email from "./Actions/Email";

function Actions(props) {
    return (
        <Btns {...props} />
    );
}

export default Actions;

var reactElements = document.getElementsByClassName("react-actions");
console.debug(reactElements);//mmmyyy
console.debug('Actions');//mmmyyy
if (reactElements) {
    [...reactElements].forEach((reactElement) => {
        ReactDOM.createRoot(reactElement).render(
            <Actions {...reactElement.dataset} />
        );
    });
}
