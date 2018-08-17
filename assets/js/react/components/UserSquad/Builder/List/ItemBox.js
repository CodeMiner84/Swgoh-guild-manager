/*eslint-disable */
import styled from 'styled-components'

export default styled.div`
    border-radius: 6px;
    -webkit-box-shadow: inset 0px 0px 31px 0px rgba(227,227,227,1);
    -moz-box-shadow: inset 0px 0px 31px 0px rgba(227,227,227,1);
    box-shadow: inset 0px 0px 31px 0px rgba(227,227,227,1);
    border: 1px solid #FFF;
    margin: 5px;
    background: #fff;
    transition: background-color 0.5s ease;
    ${props => props.active && !props.chosen ? `
    background: #ccc;
    cursor: pointer;` :
  (props.diableHover || props.disabled ? '' : `&:hover, &:focus {
        background: #FFF;
        cursor: pointer;
        box-shadow: none;
        border: 1px solid #aaa;
        img {
          opacity: 1;
        }
      }`)}
    ${props => props.disabled && `
    background: rgba(255, 0, 0, 0.1);
    opacity: 0.2;
    `
  }
`
/*eslint-enable */
