import styled from 'styled-components'

export default styled.div`
    text-align: center;
    padding: 4px 0;
    img {
      width: 80px;
      height: 80px;
      border-radius: 40px;
      border: 3px solid ${props => (props.side === 0 ? '#b03233' : '#3f8cba')};
    }
`
