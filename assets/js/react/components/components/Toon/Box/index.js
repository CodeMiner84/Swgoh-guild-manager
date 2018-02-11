import styled from 'styled-components'

export default styled.div`
    border-radius: 6px;
    -webkit-box-shadow: inset 0px 0px 31px 0px rgba(227,227,227,1);
    -moz-box-shadow: inset 0px 0px 31px 0px rgba(227,227,227,1);
    box-shadow: inset 0px 0px 31px 0px rgba(227,227,227,1);
    border: 1px solid #FFF;
    margin: 5px;
    &:hover, &:focus {
      background: #FFF;
      box-shadow: none;
      border: 1px solid #aaa;
      img {
        opacity: 1;
      }
    }
`
