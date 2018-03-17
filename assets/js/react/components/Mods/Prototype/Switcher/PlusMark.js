import styled from 'styled-components'

export default styled.div`
    position: absolute;
    width: 40px;
    height: 40px;
    line-height: 40px;
    text-align: center;
    cursor: pointer;
    float: left;
    &:hover {
      * {
        color: #FFF;
        text-shadow: 0 0 60px #FFF;
        transition: all 0.5s ease;
      }
    }
    span {
      margin-left: 26px;
    }
    ${props => props.type === 'square' && `
      left: ${props.active ? '29px' : '25px'};
      top: 35px;
    `}
    ${props => props.type === 'arrow' && `
      left: ${props.active ? '118px' : '118px'};
      top: 23px;
      img {
        max-width: 76px !important;
      }
    `}
    ${props => props.type === 'diamond' && `
      left: ${props.active ? '39px' : '38px'};
      top: 182px;
      img {
        max-width: 76px !important;
      }
    `}
    ${props => props.type === 'triangle' && `
    left: ${props.active ? '109px' : '105px'};
    top: ${props.active ? '150px' : '154px'};
    `}
    ${props => props.type === 'circle' && `
      left: ${props.active ? '40px' : '38px'};
      top: ${props.active ? '294px' : '292px'};
    `}
    ${props => props.type === 'cross' && `
      left: ${props.active ? '120px' : '118px'};
      top: 260px;
      img {
        max-width: 76px !important;
      }
    `}
`
