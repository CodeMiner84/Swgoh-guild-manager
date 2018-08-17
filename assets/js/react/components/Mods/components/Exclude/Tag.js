import styled from 'styled-components';

export default styled.div`
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 5px 10px;
    width: 100%;
    margin: 10px 0;
    font-size: 12px;
    
    div.tagsContainer {
      margin-top: 10px;
    }

div.tags {
    position: relative;
    z-index: 2;
}

/* Styles for the input */
div.tagInput {
    width: 200px;
    border-radius: 2px;
    display: inline-block;
    float: left;
}
div.tagInput input.tagInputField,
div.tagInput input.tagInputField:focus {
    height: 31px;
    margin: 0;
    font-size: 12px;
    width: 100%;
    border: 1px solid #eee;
    text-indent: 10px;
    outline: 0 !important;
}

/* Styles for selected tags */
div.selected span.tag {
    border: 1px solid #ddd;
    background: #eee;
    font-size: 12px;
    display: inline-block;
    padding: 5px;
    margin: 0 5px;
    cursor: move;
    border-radius: 2px;
}
div.selected a.remove {
    color: #aaa;
    margin-left: 5px;
    cursor: pointer;
}

/* Styles for suggestions */
div.suggestions {
    position: absolute;
}
div.suggestions ul {
    list-style-type: none;
    box-shadow: .05em .01em .5em rgba(0,0,0,.2);
    background: white;
    margin: 0;
    padding: 0;
    width: 200px;
}
div.suggestions li {
    border-bottom: 1px solid #ddd;
    padding: 5px 10px;
    margin: 0;
}
div.suggestions li mark {
    text-decoration: underline;
    background: none;
    font-weight: 600;
}
div.suggestions ul li.activeSuggestion {
    background: #b7cfe0;
    cursor: pointer;
}

`;
