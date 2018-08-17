import styled from 'styled-components'

export default styled.div`
    text-align: center;
    padding: 4px 0;
    img {
      width: 60px;
      height: 60px;
      border-radius: 30px;
      border: 2px solid ${props => (props.side === 0 ? '#b03233' : '#3f8cba')};
    }
`
