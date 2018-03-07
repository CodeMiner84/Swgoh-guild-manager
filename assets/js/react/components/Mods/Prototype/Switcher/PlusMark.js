import styled from 'styled-components';

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
    ${props => props.type === 'square' && `
      left: 43px;
      top: 35px;
    `}
    ${props => props.type === 'arrow' && `
      left: 136px;
      top: 22px;
    `}
    ${props => props.type === 'diamond' && `
      left: 56px;
      top: 182px;
    `}
    ${props => props.type === 'triangle' && `
    left: 123px;
    top: 153px;
    `}
    ${props => props.type === 'circle' && `
      left: 56px;
      top: 292px;
    `}
    ${props => props.type === 'cross' && `
      left: 136px;
      top: 260px;
    `}
`;
