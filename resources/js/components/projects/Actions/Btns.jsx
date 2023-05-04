import { useState } from "react";

import Delete from "./Delete";
import Email from "./Email";

function Btns(props) {
    const [deleteModalIsOpen, setDeleteModalIsOpen] = useState(false);
    const [emailModalIsOpen, setEmailModalIsOpen] = useState(false);
    function openDeleteModalHandler() {
        setDeleteModalIsOpen(true);
    }
    function openEmailModalHandler() {
        setEmailModalIsOpen(true);
    }
    function closeModalHandler(e) {
        console.debug('cccccccc');//mmmyyy
        console.debug(!e.target.closest(".modal-content"));//mmmyyy
        console.debug(e.target.closest(".modal-content"));//mmmyyy
        if (
            e.target.closest(".close-modal") ||
            !e.target.closest(".modal-content")
        ) {
            setEmailModalIsOpen(false);
            setDeleteModalIsOpen(false);
        }
    }
    const project = projectsData[props.id];
    return (
        <>
            <Delete
                id={props.id}
                modalIsOpen={deleteModalIsOpen}
                openModalHandler={openDeleteModalHandler}
                closeModalHandler={closeModalHandler}
                project={project}
            />
            <div className="mt-1" />
            <Email
                id={props.id}
                modalIsOpen={emailModalIsOpen}
                openModalHandler={openEmailModalHandler}
                closeModalHandler={closeModalHandler}
                project={project}
            />
        </>
    );
}

export default Btns;
