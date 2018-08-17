import styled from 'styled-components'

export default styled.div`
    font-weight: ${props => (props.kind === 0 ? 'bold' : 'normal')};
    color: ${props => (props.active ? '#FF0000' : '#000')};
`
