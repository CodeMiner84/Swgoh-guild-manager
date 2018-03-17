import styled from 'styled-components'
import { Label } from 'react-bootstrap'

export default styled(Label)`
    width: 12.5%;
    margin: 0;
    border-radius: 0;
    border: 1px solid #bbb;
    &:hover{
      background-color: #dcdcdc;
    }
    background: ${props => props.active ? '#FF0000' : 'inherit'};
`
